<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Advertisement extends Model
{
    /** @use HasFactory<\Database\Factories\AdvertisementFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * In accordance with Hardened Playbook AppSec rules, credits_allocated,
     * impressions, clicks, and status are strictly excluded from $fillable
     * and must be modified exclusively via dedicated domain Actions.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'target_url',
        'banner_url',
        'type',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'credits_allocated' => 'integer',
            'impressions' => 'integer',
            'clicks' => 'integer',
        ];
    }

    /**
     * Get the user that created this advertisement.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the recorded clicks for this advertisement.
     *
     * @return HasMany<AdvertisementClick, $this>
     */
    public function clicksHistory(): HasMany
    {
        return $this->hasMany(AdvertisementClick::class);
    }
}
