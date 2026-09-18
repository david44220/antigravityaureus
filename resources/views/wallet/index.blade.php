@extends('layouts.app')

@section('title', 'Wallet & Ledger')

@section('content')
<div class="space-y-8">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-6 border-b border-amber-400/20">
        <div>
            <div class="text-xs font-bold uppercase tracking-widest text-amber-700">Financial Treasury</div>
            <h1 class="text-3xl font-bold font-luxury-title text-slate-900 mt-1">Wallet & Ledger Audit Trail</h1>
            <p class="text-sm text-slate-500 mt-0.5">Pessimistically row-locked internal balances with double-entry integrity.</p>
        </div>
    </div>

    <!-- Balance Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Purchase Balance -->
        <div class="gold-card p-6">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Purchase Balance</span>
                <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
            </div>
            <div class="text-3xl font-bold font-mono text-slate-900 mt-3">${{ number_format((float) $wallet->purchase_balance, 2) }}</div>
            <p class="text-xs text-slate-500 mt-1">Dedicated fund pool for acquiring advertising packs.</p>

            <!-- Quick Deposit Form -->
            <form action="{{ route('wallet.deposit') }}" method="POST" class="mt-5 pt-4 border-t border-slate-100 flex gap-2">
                @csrf
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-mono text-xs">$</span>
                    <input 
                        type="number" 
                        name="amount" 
                        step="0.01" 
                        min="5" 
                        max="10000" 
                        value="100.00" 
                        required 
                        class="w-full pl-7 pr-3 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs font-mono font-semibold focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 focus:outline-hidden">
                </div>
                <button type="submit" class="px-4 py-2 rounded-xl gold-gradient-bg text-white text-xs font-semibold shadow-xs hover:brightness-105 transition shrink-0">
                    Deposit
                </button>
            </form>
        </div>

        <!-- Earnings Balance -->
        <div class="gold-card p-6 border-amber-400/50 bg-gradient-to-br from-white to-amber-50/40">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-800">Earnings Balance (ROI)</span>
                <span class="w-3 h-3 rounded-full gold-gradient-bg"></span>
            </div>
            <div class="text-3xl font-bold font-mono text-amber-900 mt-3">${{ number_format((float) $wallet->earnings_balance, 2) }}</div>
            <p class="text-xs text-amber-800/80 mt-1">Accumulated returns paid directly upon cycler queue completions.</p>
        </div>

        <!-- Ad Credits -->
        <div class="gold-card p-6">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Directory Ad Credits</span>
                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold">Impressions</span>
            </div>
            <div class="text-3xl font-bold font-mono text-slate-900 mt-3">{{ number_format($wallet->ad_credits) }}</div>
            <p class="text-xs text-slate-500 mt-1">Earned via pack purchases to promote directory campaigns.</p>
            <div class="mt-5 pt-4 border-t border-slate-100">
                <a href="{{ route('ads.index') }}" class="block text-center py-2 rounded-xl bg-slate-100 hover:bg-amber-50 text-slate-700 hover:text-amber-900 border border-slate-200 text-xs font-semibold transition">
                    Manage Ad Campaigns &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Complete Transactions Table -->
    <div class="gold-card p-6">
        <h2 class="text-lg font-bold text-slate-900 font-serif mb-4">Complete Audit Ledger</h2>

        @if ($transactions->isEmpty())
            <p class="text-xs text-slate-500 text-center py-8">No transaction activity recorded yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-500 uppercase tracking-wider font-semibold">
                            <th class="pb-3">ID</th>
                            <th class="pb-3">Timestamp</th>
                            <th class="pb-3">Action Type</th>
                            <th class="pb-3">Target Wallet</th>
                            <th class="pb-3">Description</th>
                            <th class="pb-3 text-right">Amount</th>
                            <th class="pb-3 text-right">Balance Before</th>
                            <th class="pb-3 text-right">Balance After</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($transactions as $tx)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 font-mono text-slate-400">#{{ $tx->id }}</td>
                                <td class="py-3 text-slate-500 font-mono text-[11px]">{{ $tx->created_at->format('M d, Y H:i:s') }}</td>
                                <td class="py-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $tx->amount >= 0 ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-slate-100 text-slate-700' }}">
                                        {{ $tx->type }}
                                    </span>
                                </td>
                                <td class="py-3 font-mono text-slate-500">{{ $tx->wallet_type }}</td>
                                <td class="py-3 text-slate-800 font-medium">{{ $tx->description }}</td>
                                <td class="py-3 text-right font-mono font-bold {{ $tx->amount >= 0 ? 'text-emerald-700' : 'text-slate-800' }}">
                                    {{ $tx->amount >= 0 ? '+' : '' }}${{ number_format((float) $tx->amount, 2) }}
                                </td>
                                <td class="py-3 text-right font-mono text-slate-400">${{ number_format((float) $tx->balance_before, 2) }}</td>
                                <td class="py-3 text-right font-mono font-semibold text-slate-700">${{ number_format((float) $tx->balance_after, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
