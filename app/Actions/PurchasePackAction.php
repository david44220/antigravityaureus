<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\AdPackPurchase;
use App\Models\AdPackTier;
use App\Models\CyclerQueue;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PurchasePackAction
{
    public function __construct(
        protected ProcessCyclerQueueAction $processCyclerQueue
    ) {}

    /**
     * Atomically purchase an ad pack, credit ad impressions, record ledger entry,
     * allocate a cycler queue position, and trigger FIFO cycler queue evaluation.
     *
     * @throws ValidationException
     */
    public function execute(User $user, int $tierId): AdPackPurchase
    {
        return DB::transaction(function () use ($user, $tierId): AdPackPurchase {
            /** @var AdPackTier $tier */
            $tier = AdPackTier::where('id', $tierId)
                ->where('is_active', true)
                ->firstOrFail();

            /** @var Wallet $wallet */
            $wallet = Wallet::where('user_id', $user->id)
                ->lockForUpdate()
                ->firstOrFail();

            $priceFormatted = number_format((float) $tier->price, 2, '.', '');

            // Concurrency check: Ensure user possesses sufficient purchase balance
            if (bccomp((string) $wallet->purchase_balance, $priceFormatted, 2) < 0) {
                throw ValidationException::withMessages([
                    'tier_id' => ["Insufficient purchase balance. Required: \${$priceFormatted}, Available: \${$wallet->purchase_balance}."],
                ]);
            }

            // Debit purchase balance and credit directory ad impressions
            $balanceBefore = $wallet->purchase_balance;
            $balanceAfter = bcsub((string) $balanceBefore, $priceFormatted, 2);

            $wallet->purchase_balance = $balanceAfter;
            $wallet->ad_credits += $tier->ad_credits_awarded;
            $wallet->save();

            // Create purchase record
            $purchase = AdPackPurchase::create([
                'user_id' => $user->id,
                'ad_pack_tier_id' => $tier->id,
                'price_paid' => $priceFormatted,
                'ad_credits_awarded' => $tier->ad_credits_awarded,
            ]);

            // Record immutable financial ledger transaction
            Transaction::create([
                'user_id' => $user->id,
                'wallet_id' => $wallet->id,
                'type' => 'PACK_PURCHASE',
                'wallet_type' => 'PURCHASE',
                'amount' => '-' . $priceFormatted,
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceAfter,
                'reference_type' => AdPackPurchase::class,
                'reference_id' => $purchase->id,
                'description' => "Purchased {$tier->name} Pack",
            ]);

            // Allocate FIFO Cycler Queue position
            $newPosition = CyclerQueue::create([
                'user_id' => $user->id,
                'ad_pack_tier_id' => $tier->id,
                'purchase_id' => $purchase->id,
                'status' => 'QUEUED',
                'downstream_count' => 0,
                'is_reentry' => false,
            ]);

            // Evaluate cycler queue advancement
            $this->processCyclerQueue->execute($tier, $newPosition);

            return $purchase;
        });
    }
}
