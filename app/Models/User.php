<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Bootstrap the model and its traits.
     * Automatically provision a wallet upon user creation.
     */
    protected static function booted(): void
    {
        static::created(function (self $user): void {
            $user->wallet()->create();
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the wallet associated with the user.
     *
     * @return HasOne<Wallet, $this>
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Get the ledger transactions recorded for the user.
     *
     * @return HasMany<Transaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the ad pack purchases made by the user.
     *
     * @return HasMany<AdPackPurchase, $this>
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(AdPackPurchase::class);
    }

    /**
     * Get the cycler queue positions owned by the user.
     *
     * @return HasMany<CyclerQueue, $this>
     */
    public function cyclerQueues(): HasMany
    {
        return $this->hasMany(CyclerQueue::class);
    }

    /**
     * Get the advertisements registered by the user.
     *
     * @return HasMany<Advertisement, $this>
     */
    public function advertisements(): HasMany
    {
        return $this->hasMany(Advertisement::class);
    }
}
