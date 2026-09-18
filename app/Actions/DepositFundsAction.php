<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class DepositFundsAction
{
    /**
     * Atomically deposit funds into the user's purchase balance with row locking.
     */
    public function execute(User $user, float|string $amount): Wallet
    {
        return DB::transaction(function () use ($user, $amount): Wallet {
            /** @var Wallet $wallet */
            $wallet = Wallet::where('user_id', $user->id)
                ->lockForUpdate()
                ->firstOrFail();

            $formattedAmount = number_format((float) $amount, 2, '.', '');
            $balanceBefore = $wallet->purchase_balance;
            $balanceAfter = bcadd((string) $balanceBefore, $formattedAmount, 2);

            $wallet->purchase_balance = $balanceAfter;
            $wallet->save();

            Transaction::create([
                'user_id' => $user->id,
                'wallet_id' => $wallet->id,
                'type' => 'DEPOSIT',
                'wallet_type' => 'PURCHASE',
                'amount' => $formattedAmount,
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceAfter,
                'reference_type' => null,
                'reference_id' => null,
                'description' => "Mock deposit of \${$formattedAmount} to purchase balance",
            ]);

            return $wallet;
        });
    }
}
