<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\AdPackTier;
use App\Models\Advertisement;
use App\Models\CyclerQueue;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\View\View;

class BrowserShowcaseController extends Controller
{
    /**
     * Display the local UI/UX component atlas and design token showcase.
     * Strictly barred from staging and production environments.
     */
    public function index(): View
    {
        abort_unless(app()->isLocal(), 403, 'Showcase route restricted to local environments.');

        // Generate or fetch representative mock data for component visual inspection
        $mockUser = User::first() ?? User::factory()->make([
            'name' => 'Alexander Vance',
            'email' => 'alexander@aureus.luxury',
        ]);

        $mockWallet = Wallet::first() ?? new Wallet([
            'purchase_balance' => '1250.00',
            'earnings_balance' => '487.50',
            'ad_credits' => 4500,
        ]);

        $tiers = AdPackTier::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        if ($tiers->isEmpty()) {
            $tiers = collect([
                new AdPackTier(['id' => 1, 'name' => 'Aurum Tier I', 'slug' => 'tier-1', 'price' => '10.00', 'ad_credits_awarded' => 1000, 'required_downstream' => 2, 'payout_amount' => '15.00']),
                new AdPackTier(['id' => 2, 'name' => 'Aurum Tier II', 'slug' => 'tier-2', 'price' => '25.00', 'ad_credits_awarded' => 3000, 'required_downstream' => 2, 'payout_amount' => '37.50']),
                new AdPackTier(['id' => 3, 'name' => 'Aurum Tier III', 'slug' => 'tier-3', 'price' => '50.00', 'ad_credits_awarded' => 7500, 'required_downstream' => 2, 'payout_amount' => '75.00']),
            ]);
        }

        $mockActivePositions = collect([
            new CyclerQueue(['id' => 101, 'ad_pack_tier_id' => 1, 'status' => 'QUEUED', 'downstream_count' => 1, 'created_at' => now()->subHours(3)]),
            new CyclerQueue(['id' => 102, 'ad_pack_tier_id' => 2, 'status' => 'QUEUED', 'downstream_count' => 0, 'created_at' => now()->subHour()]),
        ]);

        $mockTransactions = collect([
            new Transaction(['type' => 'CYCLER_PAYOUT', 'wallet_type' => 'EARNINGS', 'amount' => '15.00', 'description' => 'Cycler ROI Payout for Aurum Tier I #88', 'created_at' => now()->subMinutes(15)]),
            new Transaction(['type' => 'PACK_PURCHASE', 'wallet_type' => 'PURCHASE', 'amount' => '-25.00', 'description' => 'Purchased Aurum Tier II Pack', 'created_at' => now()->subHours(2)]),
            new Transaction(['type' => 'DEPOSIT', 'wallet_type' => 'PURCHASE', 'amount' => '100.00', 'description' => 'Deposit funds to purchase balance', 'created_at' => now()->subDay()]),
        ]);

        $mockAds = collect([
            new Advertisement(['title' => 'Prime Sovereign Wealth', 'description' => 'Global private equity access and sovereign wealth management.', 'target_url' => 'https://example.com', 'type' => 'TEXT', 'credits_allocated' => 840, 'impressions' => 1200, 'clicks' => 48, 'status' => 'ACTIVE']),
            new Advertisement(['title' => 'Monaco Yacht Club Charter', 'description' => 'Exclusive Mediterranean superyacht voyages.', 'target_url' => 'https://example.com', 'banner_url' => 'https://images.unsplash.com/photo-1569263979104-865ab7cd8d13?w=800', 'type' => 'BANNER', 'credits_allocated' => 250, 'impressions' => 640, 'clicks' => 31, 'status' => 'ACTIVE']),
        ]);

        return view('browser.showcase', compact(
            'mockUser',
            'mockWallet',
            'tiers',
            'mockActivePositions',
            'mockTransactions',
            'mockAds'
        ));
    }
}
