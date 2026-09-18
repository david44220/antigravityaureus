<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\AdPackTier;
use App\Models\CyclerQueue;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CyclerQueue>
 */
class CyclerQueueFactory extends Factory
{
    protected $model = CyclerQueue::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'ad_pack_tier_id' => AdPackTier::factory(),
            'purchase_id' => null,
            'status' => 'QUEUED',
            'downstream_count' => 0,
            'payout_amount' => null,
            'is_reentry' => false,
            'cycled_at' => null,
        ];
    }
}
