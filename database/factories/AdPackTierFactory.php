<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\AdPackTier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AdPackTier>
 */
class AdPackTierFactory extends Factory
{
    protected $model = AdPackTier::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Aurum Tier ' . fake()->unique()->numberBetween(1, 100),
            'slug' => 'tier-' . fake()->unique()->slug(2),
            'price' => 10.00,
            'ad_credits_awarded' => 1000,
            'required_downstream' => 2,
            'payout_amount' => 15.00,
            'auto_reentry' => false,
            'is_active' => true,
            'sort_order' => 1,
        ];
    }
}
