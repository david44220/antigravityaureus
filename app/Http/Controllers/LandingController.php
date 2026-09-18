<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\AdPackTier;
use Illuminate\View\View;

class LandingController extends Controller
{
    /**
     * Display the public luxury landing page for Aureus Ad Cycler.
     */
    public function index(): View
    {
        $tiers = AdPackTier::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('welcome', compact('tiers'));
    }
}
