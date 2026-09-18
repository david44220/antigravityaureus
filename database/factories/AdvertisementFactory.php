<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Advertisement>
 */
class AdvertisementFactory extends Factory
{
    protected $model = Advertisement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(2),
            'target_url' => 'https://example.com/' . fake()->slug(),
            'banner_url' => null,
            'type' => 'TEXT',
            'credits_allocated' => 500,
            'impressions' => 0,
            'clicks' => 0,
            'status' => 'ACTIVE',
        ];
    }
}
