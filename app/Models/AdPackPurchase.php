<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AdPackPurchase extends Model
{
    /** @use HasFactory<\Database\Factories\AdPackPurchaseFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'ad_pack_tier_id',
        'price_paid',
        'ad_credits_awarded',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price_paid' => 'decimal:2',
            'ad_credits_awarded' => 'integer',
        ];
    }

    /**
     * Get the user who made the purchase.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tier that was purchased.
     *
     * @return BelongsTo<AdPackTier, $this>
     */
    public function tier(): BelongsTo
    {
        return $this->belongsTo(AdPackTier::class, 'ad_pack_tier_id');
    }

    /**
     * Get the cycler queue position allocated for this purchase.
     *
     * @return HasOne<CyclerQueue, $this>
     */
    public function cyclerQueue(): HasOne
    {
        return $this->hasOne(CyclerQueue::class, 'purchase_id');
    }
}
