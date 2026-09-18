<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Advertisement;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AllocateAdCreditsAction
{
    /**
     * Atomically transfer advertising credits from the user's wallet to an active advertisement campaign.
     *
     * @throws ValidationException
     */
    public function execute(User $user, Advertisement $advertisement, int $credits): Advertisement
    {
        return DB::transaction(function () use ($user, $advertisement, $credits): Advertisement {
            /** @var Wallet $wallet */
            $wallet = Wallet::where('user_id', $user->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($wallet->ad_credits < $credits) {
                throw ValidationException::withMessages([
                    'credits' => ["Insufficient advertising credits. Required: {$credits}, Available: {$wallet->ad_credits}."],
                ]);
            }

            // Deduct credits from user wallet
            $creditsBefore = $wallet->ad_credits;
            $wallet->ad_credits -= $credits;
            $wallet->save();

            // Allocate credits to advertisement campaign
            $advertisement->credits_allocated += $credits;
            if ($advertisement->status === 'DEPLETED') {
                $advertisement->status = 'ACTIVE';
            }
            $advertisement->save();

            // Record ledger entry
            Transaction::create([
                'user_id' => $user->id,
                'wallet_id' => $wallet->id,
                'type' => 'CREDIT_ALLOCATION',
                'wallet_type' => 'AD_CREDITS',
                'amount' => (string) (-$credits),
                'balance_before' => (string) $creditsBefore,
                'balance_after' => (string) $wallet->ad_credits,
                'reference_type' => Advertisement::class,
                'reference_id' => $advertisement->id,
                'description' => "Allocated {$credits} ad credits to '{$advertisement->title}'",
            ]);

            return $advertisement;
        });
    }
}
