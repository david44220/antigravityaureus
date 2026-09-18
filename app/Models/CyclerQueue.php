<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CyclerQueue extends Model
{
    /** @use HasFactory<\Database\Factories\CyclerQueueFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'ad_pack_tier_id',
        'purchase_id',
        'status',
        'downstream_count',
        'payout_amount',
        'is_reentry',
        'cycled_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'downstream_count' => 'integer',
            'payout_amount' => 'decimal:2',
            'is_reentry' => 'boolean',
            'cycled_at' => 'datetime',
        ];
    }

    /**
     * Get the owner of this queue position.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tier associated with this queue position.
     *
     * @return BelongsTo<AdPackTier, $this>
     */
    public function tier(): BelongsTo
    {
        return $this->belongsTo(AdPackTier::class, 'ad_pack_tier_id');
    }

    /**
     * Get the purchase that created this position.
     *
     * @return BelongsTo<AdPackPurchase, $this>
     */
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(AdPackPurchase::class, 'purchase_id');
    }
}
