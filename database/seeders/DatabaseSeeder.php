<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdPackTierSeeder::class,
        ]);

        $user = User::firstOrCreate(
            ['email' => 'demo@aureus.test'],
            [
                'name' => 'Aureus Investor',
                'password' => bcrypt('password'),
            ]
        );

        $wallet = $user->wallet ?? $user->wallet()->create();
        $wallet->purchase_balance = 500.00;
        $wallet->earnings_balance = 150.00;
        $wallet->ad_credits = 2500;
        $wallet->save();
    }
}
