@extends('layouts.app')

@section('title', 'Executive Dashboard')

@section('content')
<div class="space-y-8">

    <!-- Hero Welcome & Executive Status -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-6 border-b border-amber-400/20">
        <div>
            <div class="text-xs font-bold uppercase tracking-widest text-amber-700">Member Portfolio</div>
            <h1 class="text-3xl font-bold font-luxury-title text-slate-900 mt-1">Welcome, {{ $user->name }}</h1>
            <p class="text-sm text-slate-500 mt-0.5">Automated FIFO Cycler Engine & Premium Advertising Exchange</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('ad-packs.index') }}" class="px-5 py-2.5 rounded-xl gold-gradient-bg text-white font-semibold text-sm shadow-sm hover:brightness-105 active:scale-95 transition flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                <span>Acquire Ad Pack</span>
            </a>
            <a href="{{ route('ads.create') }}" class="px-4 py-2.5 rounded-xl bg-white border border-amber-400/30 text-slate-800 font-semibold text-sm hover:bg-amber-50/50 transition">
                Create Campaign
            </a>
        </div>
    </div>

    <!-- 4-Stat Metric Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Purchase Balance -->
        <div class="gold-card p-5 relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Purchase Balance</span>
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 ring-4 ring-emerald-100"></span>
            </div>
            <div class="mt-3">
                <div class="text-2xl lg:text-3xl font-bold text-slate-900 font-mono">${{ number_format((float) $wallet->purchase_balance, 2) }}</div>
                <div class="text-xs text-slate-500 mt-1 flex items-center justify-between">
                    <span>Available for packs</span>
                    <a href="{{ route('wallet.index') }}" class="text-amber-700 font-semibold hover:underline">+ Top up</a>
                </div>
            </div>
        </div>

        <!-- Earnings Balance -->
        <div class="gold-card p-5 relative overflow-hidden group border-amber-400/40 bg-gradient-to-br from-white to-amber-50/30">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-800">Earnings (ROI)</span>
                <span class="w-2.5 h-2.5 rounded-full gold-gradient-bg ring-4 ring-amber-200/50"></span>
            </div>
            <div class="mt-3">
                <div class="text-2xl lg:text-3xl font-bold text-amber-900 font-mono">${{ number_format((float) $wallet->earnings_balance, 2) }}</div>
                <div class="text-xs text-amber-800/80 mt-1 flex items-center justify-between">
                    <span>Cycler payouts credited</span>
                    <span class="font-medium text-[11px] bg-amber-100/80 px-2 py-0.5 rounded-full">150% ROI Yield</span>
                </div>
            </div>
        </div>

        <!-- Ad Traffic Credits -->
        <div class="gold-card p-5 relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Ad Traffic Credits</span>
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
            </div>
            <div class="mt-3">
                <div class="text-2xl lg:text-3xl font-bold text-slate-900 font-mono">{{ number_format($wallet->ad_credits) }}</div>
                <div class="text-xs text-slate-500 mt-1 flex items-center justify-between">
                    <span>Directory impressions</span>
                    <a href="{{ route('ads.index') }}" class="text-amber-700 font-semibold hover:underline">Allocate</a>
                </div>
            </div>
        </div>

        <!-- Cycler Positions -->
        <div class="gold-card p-5 relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Queue Positions</span>
                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-mono text-[11px] font-bold">{{ $activePositions->count() }} active</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl lg:text-3xl font-bold text-slate-900 font-mono">{{ $completedPositionsCount }}</div>
                <div class="text-xs text-slate-500 mt-1 flex items-center justify-between">
                    <span>Total positions completed</span>
                    <a href="{{ route('cycler.index') }}" class="text-amber-700 font-semibold hover:underline">View queue</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Cycler Positions Section -->
    <div class="gold-card p-6">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-amber-400/15">
            <div>
                <h2 class="text-lg font-bold text-slate-900 font-serif">Active FIFO Queue Positions</h2>
                <p class="text-xs text-slate-500">Positions advance as new downstream members acquire matching packs.</p>
            </div>
            <a href="{{ route('cycler.index') }}" class="text-xs font-semibold text-amber-700 hover:text-amber-900">Full Queue &rarr;</a>
        </div>

        @if ($activePositions->isEmpty())
            <div class="text-center py-10 px-4">
                <div class="w-12 h-12 rounded-2xl gold-gradient-bg flex items-center justify-center text-white mx-auto mb-3 shadow-xs">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-800">No active positions in queue</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Acquire an advertising pack to gain directory traffic credits and take your place in the automated cycler queue.</p>
                <div class="mt-4">
                    <a href="{{ route('ad-packs.index') }}" class="px-4 py-2 rounded-xl gold-gradient-bg text-white text-xs font-semibold shadow-xs hover:brightness-105 transition">Explore Ad Pack Tiers</a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($activePositions as $position)
                    @php
                        $req = $position->tier->required_downstream;
                        $count = $position->downstream_count;
                        $pct = min(100, round(($count / $req) * 100));
                    @endphp
                    <div class="p-4 rounded-xl border border-amber-200/70 bg-gradient-to-b from-white to-amber-50/20 shadow-xs">
                        <div class="flex items-center justify-between">
                            <span class="font-serif font-bold text-sm text-slate-900">{{ $position->tier->name }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-900 border border-amber-300/60">Position #{{ $position->id }}</span>
                        </div>
                        <div class="mt-3 flex items-baseline justify-between text-xs">
                            <span class="text-slate-500">Downstream Progress:</span>
                            <span class="font-mono font-bold text-slate-800">{{ $count }} / {{ $req }} ({{ $pct }}%)</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-100 mt-1.5 overflow-hidden border border-slate-200">
                            <div class="h-full gold-gradient-bg transition-all duration-500" style="width: {{ $pct }}%"></div>
                        </div>
                        <div class="mt-3 pt-3 border-t border-amber-400/15 flex items-center justify-between text-xs">
                            <span class="text-slate-500">ROI Upon Cycle:</span>
                            <span class="font-mono font-bold text-emerald-700">+${{ number_format((float) $position->tier->payout_amount, 2) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Recent Transactions Ledger -->
    <div class="gold-card p-6">
        <div class="flex items-center justify-between mb-4 pb-4 border-b border-amber-400/15">
            <div>
                <h2 class="text-lg font-bold text-slate-900 font-serif">Recent Audit Ledger Activity</h2>
                <p class="text-xs text-slate-500">Immutable double-entry transaction record.</p>
            </div>
            <a href="{{ route('wallet.index') }}" class="text-xs font-semibold text-amber-700 hover:text-amber-900">View All &rarr;</a>
        </div>

        @if ($recentTransactions->isEmpty())
            <p class="text-xs text-slate-500 text-center py-6">No transaction activity recorded yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-500 uppercase tracking-wider font-semibold">
                            <th class="pb-3">Timestamp</th>
                            <th class="pb-3">Type</th>
                            <th class="pb-3">Description</th>
                            <th class="pb-3 text-right">Amount</th>
                            <th class="pb-3 text-right">Balance After</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($recentTransactions as $tx)
                            <tr>
                                <td class="py-3 text-slate-500 font-mono text-[11px]">{{ $tx->created_at->format('M d, Y H:i') }}</td>
                                <td class="py-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $tx->amount >= 0 ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-slate-100 text-slate-700' }}">
                                        {{ $tx->type }}
                                    </span>
                                </td>
                                <td class="py-3 text-slate-800 font-medium">{{ $tx->description }}</td>
                                <td class="py-3 text-right font-mono font-bold {{ $tx->amount >= 0 ? 'text-emerald-700' : 'text-slate-800' }}">
                                    {{ $tx->amount >= 0 ? '+' : '' }}${{ number_format((float) $tx->amount, 2) }}
                                </td>
                                <td class="py-3 text-right font-mono text-slate-500">${{ number_format((float) $tx->balance_after, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection
