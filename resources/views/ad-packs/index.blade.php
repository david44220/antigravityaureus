@extends('layouts.app')

@section('title', 'Advertising Packs Catalog')

@section('content')
<div class="space-y-8">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-6 border-b border-amber-400/20">
        <div>
            <div class="text-xs font-bold uppercase tracking-widest text-amber-700">Prestige Catalog</div>
            <h1 class="text-3xl font-bold font-luxury-title text-slate-900 mt-1">Acquire Advertising Packs</h1>
            <p class="text-sm text-slate-500 mt-0.5">Every acquisition awards directory advertising credits and enters the 150% ROI FIFO queue.</p>
        </div>
        <div class="p-3 rounded-2xl bg-white border border-amber-400/30 flex items-center space-x-3 shadow-xs">
            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
            <div>
                <span class="text-[11px] uppercase tracking-wider text-slate-500 block font-semibold">Your Purchase Balance:</span>
                <span class="text-lg font-bold font-mono text-slate-900">${{ number_format((float) $wallet->purchase_balance, 2) }}</span>
            </div>
            <a href="{{ route('wallet.index') }}" class="ml-2 px-3 py-1.5 rounded-xl gold-gradient-bg text-white text-xs font-semibold shadow-xs hover:brightness-105 transition">
                + Deposit
            </a>
        </div>
    </div>

    <!-- Tiers Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($tiers as $tier)
            @php
                $canAfford = bccomp((string) $wallet->purchase_balance, (string) $tier->price, 2) >= 0;
            @endphp
            <div class="gold-card p-6 flex flex-col justify-between relative overflow-hidden transition-all duration-300 {{ $tier->price == 25 ? 'ring-2 ring-amber-400/50 shadow-md' : '' }}">
                @if ($tier->price == 25)
                    <div class="absolute top-0 right-0 bg-gradient-to-l from-amber-500 to-yellow-500 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-bl-xl shadow-xs">
                        Most Popular
                    </div>
                @endif

                <div>
                    <div class="flex items-center space-x-2">
                        <span class="w-2.5 h-2.5 rounded-full gold-gradient-bg"></span>
                        <h2 class="font-serif font-bold text-xl text-slate-900">{{ $tier->name }}</h2>
                    </div>

                    <div class="mt-4 flex items-baseline space-x-2">
                        <span class="text-4xl font-bold font-mono text-slate-900">${{ number_format((float) $tier->price, 2) }}</span>
                        <span class="text-xs text-slate-500">/ single pack</span>
                    </div>

                    <div class="mt-6 space-y-3 pb-6 border-b border-slate-100 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600 flex items-center space-x-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Directory Traffic Credits</span>
                            </span>
                            <span class="font-mono font-bold text-slate-900">{{ number_format($tier->ad_credits_awarded) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600 flex items-center space-x-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Downstream to Cycle</span>
                            </span>
                            <span class="font-mono font-bold text-slate-900">{{ $tier->required_downstream }} Positions</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600 flex items-center space-x-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>ROI Yield (Payout)</span>
                            </span>
                            <span class="font-mono font-bold text-emerald-700 text-sm">${{ number_format((float) $tier->payout_amount, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-[11px] text-amber-800 bg-amber-50/80 p-2 rounded-lg">
                            <span>Return on Capital</span>
                            <span class="font-bold">150% Guaranteed Return</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    @if ($canAfford)
                        <form action="{{ route('ad-packs.buy') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tier_id" value="{{ $tier->id }}">
                            <button type="submit" class="w-full py-3 rounded-xl gold-gradient-bg text-white font-semibold text-sm shadow-xs hover:brightness-105 active:scale-95 transition">
                                Acquire Pack & Enter Queue
                            </button>
                        </form>
                    @else
                        <a href="{{ route('wallet.index') }}" class="block text-center w-full py-3 rounded-xl bg-slate-100 border border-slate-200 text-slate-500 hover:text-amber-800 hover:bg-amber-50 text-xs font-semibold transition">
                            Insufficient Balance — Deposit Funds
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Mechanics Infographic Strip -->
    <div class="gold-card p-6 bg-gradient-to-r from-white via-amber-50/20 to-white">
        <h3 class="text-sm font-bold uppercase tracking-wider text-amber-800 mb-4 font-serif">How the Aureus Cycler Engine Works</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
            <div class="p-4 rounded-xl bg-white border border-amber-200/50">
                <div class="w-7 h-7 rounded-lg gold-gradient-bg flex items-center justify-center text-white font-bold mb-2">1</div>
                <div class="font-bold text-slate-900">Purchase Pack</div>
                <p class="text-slate-500 mt-1">Select a tier. Cost is debited from your purchase balance inside an atomic transaction.</p>
            </div>
            <div class="p-4 rounded-xl bg-white border border-amber-200/50">
                <div class="w-7 h-7 rounded-lg gold-gradient-bg flex items-center justify-center text-white font-bold mb-2">2</div>
                <div class="font-bold text-slate-900">Receive Ad Credits</div>
                <p class="text-slate-500 mt-1">Immediately receive directory traffic credits to promote your banners and websites.</p>
            </div>
            <div class="p-4 rounded-xl bg-white border border-amber-200/50">
                <div class="w-7 h-7 rounded-lg gold-gradient-bg flex items-center justify-center text-white font-bold mb-2">3</div>
                <div class="font-bold text-slate-900">Join FIFO Queue</div>
                <p class="text-slate-500 mt-1">Your position enters the automated tier queue in strict First-In, First-Out sequence.</p>
            </div>
            <div class="p-4 rounded-xl bg-white border border-amber-200/50">
                <div class="w-7 h-7 rounded-lg gold-gradient-bg flex items-center justify-center text-white font-bold mb-2">4</div>
                <div class="font-bold text-slate-900">Cycle & Payout</div>
                <p class="text-slate-500 mt-1">When 2 downstream positions join behind you, your position cycles, paying 150% ROI into earnings!</p>
            </div>
        </div>
    </div>

</div>
@endsection
