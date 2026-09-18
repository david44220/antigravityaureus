<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\RecordAdClickAction;
use App\Actions\RecordAdImpressionAction;
use App\Models\Advertisement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdDirectoryController extends Controller
{
    /**
     * Display the member directory traffic exchange.
     */
    public function index(Request $request, RecordAdImpressionAction $recordImpression): View
    {
        $ads = Advertisement::where('status', 'ACTIVE')
            ->where('credits_allocated', '>', 0)
            ->inRandomOrder()
            ->paginate(12);

        // Record impressions for all rendered advertisements in this view
        foreach ($ads as $ad) {
            $recordImpression->execute($ad);
        }

        return view('directory.index', compact('ads'));
    }

    /**
     * Track a click on an advertisement and securely redirect the user.
     */
    public function click(
        Request $request,
        Advertisement $ad,
        RecordAdClickAction $recordClick
    ): RedirectResponse {
        $ip = $request->ip() ?? '127.0.0.1';
        $userAgent = $request->userAgent();

        $targetUrl = $recordClick->execute($ad, $request->user(), $ip, $userAgent);

        return redirect()->away($targetUrl);
    }
}
