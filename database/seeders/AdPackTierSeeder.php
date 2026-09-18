<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AdPackTier;
use Illuminate\Database\Seeder;

class AdPackTierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiers = [
            [
                'name' => 'Aurum Tier I',
                'slug' => 'tier-1',
                'price' => 10.00,
                'ad_credits_awarded' => 1000,
                'required_downstream' => 2,
                'payout_amount' => 15.00,
                'auto_reentry' => false,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Aurum Tier II',
                'slug' => 'tier-2',
                'price' => 25.00,
                'ad_credits_awarded' => 3000,
                'required_downstream' => 2,
                'payout_amount' => 37.50,
                'auto_reentry' => false,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Aurum Tier III',
                'slug' => 'tier-3',
                'price' => 50.00,
                'ad_credits_awarded' => 7500,
                'required_downstream' => 2,
                'payout_amount' => 75.00,
                'auto_reentry' => false,
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($tiers as $tier) {
            AdPackTier::updateOrCreate(['slug' => $tier['slug']], $tier);
        }
    }
}
