<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\Wallet;

class WalletPolicy
{
    /**
     * Determine whether the user can view the wallet.
     */
    public function view(User $user, Wallet $wallet): bool
    {
        return $user->id === $wallet->user_id;
    }

    /**
     * Determine whether the user can deposit funds into the wallet.
     */
    public function deposit(User $user, Wallet $wallet): bool
    {
        return $user->id === $wallet->user_id;
    }
}
