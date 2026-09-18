<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CyclerQueue;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CyclerQueueController extends Controller
{
    /**
     * Display the user's active and completed cycler positions.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $activePositions = CyclerQueue::with('tier')
            ->where('user_id', $user->id)
            ->where('status', 'QUEUED')
            ->orderBy('id', 'asc')
            ->get();

        $completedPositions = CyclerQueue::with('tier')
            ->where('user_id', $user->id)
            ->where('status', 'COMPLETED')
            ->orderBy('cycled_at', 'desc')
            ->paginate(15);

        return view('cycler.index', compact('user', 'activePositions', 'completedPositions'));
    }
}
