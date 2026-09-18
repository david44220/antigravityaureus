@extends('layouts.app')

@section('title', 'Member Traffic Directory')

@section('content')
<div class="space-y-8">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-6 border-b border-amber-400/20">
        <div>
            <div class="text-xs font-bold uppercase tracking-widest text-amber-700">Traffic Exchange</div>
            <h1 class="text-3xl font-bold font-luxury-title text-slate-900 mt-1">Member Directory Exchange</h1>
            <p class="text-sm text-slate-500 mt-0.5">Explore active community offerings. Impressions are verified and credited in real-time.</p>
        </div>
        <a href="{{ route('ads.create') }}" class="px-5 py-2.5 rounded-xl gold-gradient-bg text-white font-semibold text-sm shadow-xs hover:brightness-105 active:scale-95 transition">
            + Place Your Ad
        </a>
    </div>

    @if ($ads->isEmpty())
        <div class="gold-card p-12 text-center">
            <div class="w-12 h-12 rounded-2xl gold-gradient-bg flex items-center justify-center text-white mx-auto mb-3 shadow-xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <h3 class="text-base font-semibold text-slate-800">Directory Queue Empty</h3>
            <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">No campaigns are currently active in the directory. Be the first member to feature your offering!</p>
            <div class="mt-4">
                <a href="{{ route('ads.create') }}" class="px-4 py-2 rounded-xl gold-gradient-bg text-white text-xs font-semibold shadow-xs hover:brightness-105 transition">
                    Launch Campaign Now
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($ads as $ad)
                <div class="gold-card p-5 flex flex-col justify-between hover:scale-[1.01] transition-all duration-300">
                    <div>
                        @if ($ad->type === 'BANNER' && $ad->banner_url)
                            <div class="w-full h-36 rounded-xl overflow-hidden mb-4 border border-slate-200 bg-slate-100">
                                <img src="{{ $ad->banner_url }}" alt="{{ $ad->title }}" class="w-full h-full object-cover" onerror="this.parentElement.style.display='none'">
                            </div>
                        @endif

                        <div class="flex items-center space-x-2 mb-2">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $ad->type === 'BANNER' ? 'bg-indigo-50 text-indigo-800' : 'bg-amber-50 text-amber-800' }}">{{ $ad->type }}</span>
                            <span class="text-[10px] text-slate-400 font-mono">ID #{{ $ad->id }}</span>
                        </div>

                        <h3 class="font-serif font-bold text-lg text-slate-900 leading-snug">{{ $ad->title }}</h3>
                        <p class="text-xs text-slate-600 mt-2 line-clamp-3 leading-relaxed">{{ $ad->description }}</p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[11px] text-slate-400 font-mono">
                            {{ number_format($ad->clicks) }} verified visit{{ $ad->clicks !== 1 ? 's' : '' }}
                        </span>
                        <a 
                            href="{{ route('directory.click', $ad) }}" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="px-4 py-2 rounded-xl gold-gradient-bg text-white text-xs font-semibold hover:brightness-105 active:scale-95 transition flex items-center space-x-1.5 shadow-xs">
                            <span>Visit Offering</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $ads->links() }}
        </div>
    @endif

</div>
@endsection
