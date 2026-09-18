<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\AdPackTier;
use App\Models\CyclerQueue;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class ProcessCyclerQueueAction
{
    /**
     * Resolve the FIFO cycler queue for a tier upon a new position entry.
     * Concurrency-safe execution with pessimistic row-locking (lockForUpdate).
     */
    public function execute(AdPackTier $tier, CyclerQueue $newPosition): void
    {
        // Find the earliest active position in this tier (FIFO) with row lock
        /** @var CyclerQueue|null $headPosition */
        $headPosition = CyclerQueue::where('ad_pack_tier_id', $tier->id)
            ->where('status', 'QUEUED')
            ->where('id', '!=', $newPosition->id)
            ->orderBy('id', 'asc')
            ->lockForUpdate()
            ->first();

        if ($headPosition === null) {
            // Newly inserted position is currently at the head of the queue
            return;
        }

        $headPosition->downstream_count += 1;

        if ($headPosition->downstream_count >= $tier->required_downstream) {
            // Position has cycled! Payout ROI to owner's earnings wallet
            $headPosition->status = 'COMPLETED';
            $headPosition->payout_amount = $tier->payout_amount;
            $headPosition->cycled_at = now();
            $headPosition->save();

            /** @var Wallet $ownerWallet */
            $ownerWallet = Wallet::where('user_id', $headPosition->user_id)
                ->lockForUpdate()
                ->firstOrFail();

            $earningsBefore = $ownerWallet->earnings_balance;
            $payoutFormatted = number_format((float) $tier->payout_amount, 2, '.', '');
            $earningsAfter = bcadd((string) $earningsBefore, $payoutFormatted, 2);

            $ownerWallet->earnings_balance = $earningsAfter;
            $ownerWallet->save();

            Transaction::create([
                'user_id' => $headPosition->user_id,
                'wallet_id' => $ownerWallet->id,
                'type' => 'CYCLER_PAYOUT',
                'wallet_type' => 'EARNINGS',
                'amount' => $payoutFormatted,
                'balance_before' => $earningsBefore,
                'balance_after' => $earningsAfter,
                'reference_type' => CyclerQueue::class,
                'reference_id' => $headPosition->id,
                'description' => "Cycler ROI Payout for {$tier->name} #{$headPosition->id}",
            ]);

            // Handle optional automatic re-entry
            if ($tier->auto_reentry) {
                $reentry = CyclerQueue::create([
                    'user_id' => $headPosition->user_id,
                    'ad_pack_tier_id' => $tier->id,
                    'purchase_id' => null,
                    'status' => 'QUEUED',
                    'downstream_count' => 0,
                    'is_reentry' => true,
                ]);

                // Cascade queue evaluation for the new re-entry position
                $this->execute($tier, $reentry);
            }
        } else {
            $headPosition->save();
        }
    }
}
