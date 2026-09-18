@extends('layouts.app')

@section('title', 'FIFO Cycler Queue')

@section('content')
<div class="space-y-8">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-6 border-b border-amber-400/20">
        <div>
            <div class="text-xs font-bold uppercase tracking-widest text-amber-700">Queue State Machine</div>
            <h1 class="text-3xl font-bold font-luxury-title text-slate-900 mt-1">FIFO Cycler Engine</h1>
            <p class="text-sm text-slate-500 mt-0.5">Strict First-In, First-Out queue mechanics with automated 150% ROI settlement.</p>
        </div>
        <a href="{{ route('ad-packs.index') }}" class="px-5 py-2.5 rounded-xl gold-gradient-bg text-white font-semibold text-sm shadow-xs hover:brightness-105 active:scale-95 transition">
            + Enter New Position
        </a>
    </div>

    <!-- Active Positions -->
    <div class="gold-card p-6">
        <h2 class="text-lg font-bold text-slate-900 font-serif mb-1">Your Active Queue Positions</h2>
        <p class="text-xs text-slate-500 mb-6">As other members acquire matching tier packs across the platform, your position advances toward cycling.</p>

        @if ($activePositions->isEmpty())
            <div class="text-center py-10 px-4">
                <div class="w-12 h-12 rounded-2xl gold-gradient-bg flex items-center justify-center text-white mx-auto mb-3 shadow-xs">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-800">No active positions in the queue</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Purchase any ad pack from the catalog to receive advertising credits and secure your priority position in the queue.</p>
                <div class="mt-4">
                    <a href="{{ route('ad-packs.index') }}" class="px-4 py-2 rounded-xl gold-gradient-bg text-white text-xs font-semibold shadow-xs hover:brightness-105 transition">Browse Pack Tiers</a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($activePositions as $pos)
                    @php
                        $req = $pos->tier->required_downstream;
                        $count = $pos->downstream_count;
                        $pct = min(100, round(($count / $req) * 100));
                    @endphp
                    <div class="p-5 rounded-xl border border-amber-200/80 bg-gradient-to-b from-white to-amber-50/25 shadow-xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="w-2.5 h-2.5 rounded-full gold-gradient-bg"></span>
                                    <span class="font-serif font-bold text-base text-slate-900">{{ $pos->tier->name }}</span>
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-amber-100 text-amber-900 border border-amber-300/80">#{{ $pos->id }}</span>
                            </div>

                            <div class="mt-4">
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-slate-500">Downstream Accumulation:</span>
                                    <span class="font-mono font-bold text-slate-800">{{ $count }} / {{ $req }} ({{ $pct }}%)</span>
                                </div>
                                <div class="w-full h-2.5 rounded-full bg-slate-100 overflow-hidden border border-slate-200">
                                    <div class="h-full gold-gradient-bg transition-all duration-500" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-t border-amber-400/15 space-y-1 text-xs">
                                <div class="flex justify-between text-slate-500">
                                    <span>Enrolled:</span>
                                    <span class="font-mono">{{ $pos->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between text-slate-500">
                                    <span>Target Payout:</span>
                                    <span class="font-mono font-bold text-emerald-700 text-sm">${{ number_format((float) $pos->tier->payout_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse mr-2"></span>
                                Awaiting {{ $req - $count }} Downstream Position{{ ($req - $count) > 1 ? 's' : '' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Cycled Positions History -->
    <div class="gold-card p-6">
        <h2 class="text-lg font-bold text-slate-900 font-serif mb-1">Completed / Cycled Positions History</h2>
        <p class="text-xs text-slate-500 mb-4">Historical record of positions that completed the queue and paid out 150% ROI.</p>

        @if ($completedPositions->isEmpty())
            <p class="text-xs text-slate-500 text-center py-6">No positions have completed yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-500 uppercase tracking-wider font-semibold">
                            <th class="pb-3">Position ID</th>
                            <th class="pb-3">Tier Name</th>
                            <th class="pb-3">Enrolled At</th>
                            <th class="pb-3">Cycled At</th>
                            <th class="pb-3">Re-entry</th>
                            <th class="pb-3 text-right">ROI Payout Awarded</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($completedPositions as $pos)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 font-mono text-slate-600 font-bold">#{{ $pos->id }}</td>
                                <td class="py-3 font-semibold text-slate-800">{{ $pos->tier->name }}</td>
                                <td class="py-3 text-slate-500 font-mono text-[11px]">{{ $pos->created_at->format('M d, Y H:i') }}</td>
                                <td class="py-3 text-slate-500 font-mono text-[11px]">{{ $pos->cycled_at ? $pos->cycled_at->format('M d, Y H:i') : '-' }}</td>
                                <td class="py-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $pos->is_reentry ? 'bg-purple-50 text-purple-800' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $pos->is_reentry ? 'Auto Re-entry' : 'Standard' }}
                                    </span>
                                </td>
                                <td class="py-3 text-right font-mono font-bold text-emerald-700 text-sm">
                                    +${{ number_format((float) $pos->payout_amount, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $completedPositions->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
