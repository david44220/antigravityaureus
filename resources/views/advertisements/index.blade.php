@extends('layouts.app')

@section('title', 'My Advertising Campaigns')

@section('content')
<div class="space-y-8">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-6 border-b border-amber-400/20">
        <div>
            <div class="text-xs font-bold uppercase tracking-widest text-amber-700">Traffic Exchange</div>
            <h1 class="text-3xl font-bold font-luxury-title text-slate-900 mt-1">My Advertising Campaigns</h1>
            <p class="text-sm text-slate-500 mt-0.5">Allocate ad credits to drive targeted traffic to your banners and websites.</p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="p-2.5 rounded-xl bg-white border border-amber-400/30 flex items-center space-x-2 shadow-xs text-xs">
                <span class="text-slate-500">Available Credits:</span>
                <span class="font-mono font-bold text-slate-900 text-sm">{{ number_format($wallet->ad_credits) }}</span>
            </div>
            <a href="{{ route('ads.create') }}" class="px-5 py-2.5 rounded-xl gold-gradient-bg text-white font-semibold text-sm shadow-xs hover:brightness-105 active:scale-95 transition">
                + Create New Ad
            </a>
        </div>
    </div>

    <!-- Campaigns List -->
    <div class="gold-card p-6">
        @if ($advertisements->isEmpty())
            <div class="text-center py-12 px-4">
                <div class="w-12 h-12 rounded-2xl gold-gradient-bg flex items-center justify-center text-white mx-auto mb-3 shadow-xs">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-800">No campaigns launched yet</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Use your awarded ad credits to place banner and text advertisements in the public directory.</p>
                <div class="mt-4">
                    <a href="{{ route('ads.create') }}" class="px-4 py-2 rounded-xl gold-gradient-bg text-white text-xs font-semibold shadow-xs hover:brightness-105 transition">Create Your First Ad</a>
                </div>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($advertisements as $ad)
                    <div class="p-5 rounded-xl border border-amber-200/70 bg-gradient-to-r from-white via-white to-amber-50/20 shadow-xs flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="space-y-1.5 flex-1">
                            <div class="flex items-center space-x-2">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $ad->type === 'BANNER' ? 'bg-indigo-50 text-indigo-800 border border-indigo-200' : 'bg-amber-50 text-amber-800 border border-amber-200' }}">{{ $ad->type }}</span>
                                <h3 class="font-serif font-bold text-base text-slate-900">{{ $ad->title }}</h3>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $ad->status === 'ACTIVE' ? 'bg-emerald-50 text-emerald-800' : 'bg-rose-50 text-rose-800' }}">{{ $ad->status }}</span>
                            </div>
                            <p class="text-xs text-slate-600 line-clamp-2">{{ $ad->description }}</p>
                            <div class="text-[11px] text-slate-400 font-mono truncate max-w-lg">
                                Target: <a href="{{ $ad->target_url }}" target="_blank" rel="noopener noreferrer" class="text-amber-700 hover:underline">{{ $ad->target_url }}</a>
                            </div>
                        </div>

                        <!-- Telemetry Stats -->
                        <div class="flex items-center gap-4 text-xs font-mono shrink-0">
                            <div class="text-center p-2 rounded-lg bg-slate-50 border border-slate-200 min-w-20">
                                <div class="text-[10px] text-slate-400 uppercase font-sans">Remaining</div>
                                <div class="font-bold text-slate-900">{{ number_format($ad->credits_allocated) }}</div>
                            </div>
                            <div class="text-center p-2 rounded-lg bg-slate-50 border border-slate-200 min-w-20">
                                <div class="text-[10px] text-slate-400 uppercase font-sans">Impressions</div>
                                <div class="font-bold text-slate-900">{{ number_format($ad->impressions) }}</div>
                            </div>
                            <div class="text-center p-2 rounded-lg bg-slate-50 border border-slate-200 min-w-20">
                                <div class="text-[10px] text-slate-400 uppercase font-sans">Clicks</div>
                                <div class="font-bold text-slate-900">{{ number_format($ad->clicks) }}</div>
                            </div>
                        </div>

                        <!-- Allocate More Credits Inline Form -->
                        <form action="{{ route('ads.allocate', $ad) }}" method="POST" class="flex items-center space-x-2 shrink-0">
                            @csrf
                            <input 
                                type="number" 
                                name="credits" 
                                min="10" 
                                max="{{ max(10, $wallet->ad_credits) }}" 
                                value="100" 
                                required 
                                class="w-20 px-2.5 py-1.5 rounded-lg border border-slate-200 text-xs font-mono text-center focus:ring-2 focus:ring-amber-500/30 focus:outline-hidden">
                            <button type="submit" class="px-3 py-1.5 rounded-lg gold-gradient-bg text-white text-xs font-semibold hover:brightness-105 transition">
                                + Allocate
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $advertisements->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
