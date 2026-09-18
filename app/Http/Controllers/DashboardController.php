<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\CyclerQueue;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the main user overview dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $wallet = $user->wallet()->firstOrCreate([]);

        $activePositions = CyclerQueue::with('tier')
            ->where('user_id', $user->id)
            ->where('status', 'QUEUED')
            ->orderBy('id', 'asc')
            ->get();

        $completedPositionsCount = CyclerQueue::where('user_id', $user->id)
            ->where('status', 'COMPLETED')
            ->count();

        $recentTransactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $adsSummary = [
            'total_ads' => Advertisement::where('user_id', $user->id)->count(),
            'total_impressions' => (int) Advertisement::where('user_id', $user->id)->sum('impressions'),
            'total_clicks' => (int) Advertisement::where('user_id', $user->id)->sum('clicks'),
        ];

        return view('dashboard', compact(
            'user',
            'wallet',
            'activePositions',
            'completedPositionsCount',
            'recentTransactions',
            'adsSummary'
        ));
    }
}
