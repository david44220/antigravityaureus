<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Advertisement;
use App\Models\User;

class AdvertisementPolicy
{
    /**
     * Determine whether the user can view the advertisement.
     */
    public function view(User $user, Advertisement $advertisement): bool
    {
        return $user->id === $advertisement->user_id;
    }

    /**
     * Determine whether the user can update the advertisement.
     */
    public function update(User $user, Advertisement $advertisement): bool
    {
        return $user->id === $advertisement->user_id;
    }

    /**
     * Determine whether the user can delete the advertisement.
     */
    public function delete(User $user, Advertisement $advertisement): bool
    {
        return $user->id === $advertisement->user_id;
    }
}
