<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\PurchasePackAction;
use App\Http\Requests\PurchasePackRequest;
use App\Models\AdPackTier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdPackController extends Controller
{
    /**
     * Display the catalog of available advertising pack tiers.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $wallet = $user->wallet()->firstOrCreate([]);

        $tiers = AdPackTier::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('ad-packs.index', compact('user', 'wallet', 'tiers'));
    }

    /**
     * Handle the purchase of an ad pack tier.
     */
    public function buy(PurchasePackRequest $request, PurchasePackAction $purchasePack): RedirectResponse
    {
        $user = $request->user();
        $tierId = (int) $request->validated('tier_id');

        $purchase = $purchasePack->execute($user, $tierId);

        return redirect()->route('cycler.index')
            ->with('status', "Successfully purchased {$purchase->tier->name} and enrolled into the cycler queue!");
    }
}
