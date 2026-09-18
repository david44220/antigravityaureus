<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\AllocateAdCreditsAction;
use App\Http\Requests\AllocateCreditsRequest;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Models\Advertisement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the user's advertisements.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $wallet = $user->wallet()->firstOrCreate([]);

        $advertisements = Advertisement::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('advertisements.index', compact('user', 'wallet', 'advertisements'));
    }

    /**
     * Show the form for creating a new advertisement.
     */
    public function create(Request $request): View
    {
        $user = $request->user();
        $wallet = $user->wallet()->firstOrCreate([]);

        return view('advertisements.create', compact('user', 'wallet'));
    }

    /**
     * Store a newly created advertisement in storage.
     */
    public function store(
        StoreAdvertisementRequest $request,
        AllocateAdCreditsAction $allocateCredits
    ): RedirectResponse {
        $user = $request->user();
        $validated = $request->validated();

        $advertisement = Advertisement::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'target_url' => $validated['target_url'],
            'banner_url' => $validated['banner_url'] ?? null,
            'type' => $validated['type'],
        ]);

        $initialCredits = (int) ($validated['initial_credits'] ?? 0);
        if ($initialCredits > 0) {
            $allocateCredits->execute($user, $advertisement, $initialCredits);
        }

        return redirect()->route('ads.index')
            ->with('status', 'Advertisement created successfully!');
    }

    /**
     * Allocate additional credits from wallet to an advertisement.
     */
    public function allocateCredits(
        AllocateCreditsRequest $request,
        Advertisement $ad,
        AllocateAdCreditsAction $allocateCredits
    ): RedirectResponse {
        $user = $request->user();

        // Enforce ownership
        if ($ad->user_id !== $user->id) {
            abort(403, 'Unauthorized access to advertisement.');
        }

        $credits = (int) $request->validated('credits');
        $allocateCredits->execute($user, $ad, $credits);

        return redirect()->route('ads.index')
            ->with('status', "Allocated {$credits} ad credits to '{$ad->title}'!");
    }
}
