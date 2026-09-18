<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdPackTier extends Model
{
    /** @use HasFactory<\Database\Factories\AdPackTierFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'price',
        'ad_credits_awarded',
        'required_downstream',
        'payout_amount',
        'auto_reentry',
        'is_active',
        'sort_order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'ad_credits_awarded' => 'integer',
            'required_downstream' => 'integer',
            'payout_amount' => 'decimal:2',
            'auto_reentry' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Get all purchases for this tier.
     *
     * @return HasMany<AdPackPurchase, $this>
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(AdPackPurchase::class);
    }

    /**
     * Get all cycler queue positions for this tier.
     *
     * @return HasMany<CyclerQueue, $this>
     */
    public function cyclerQueues(): HasMany
    {
        return $this->hasMany(CyclerQueue::class);
    }
}
