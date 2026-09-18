@extends('layouts.app')

@section('title', 'Create Advertisement')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="pb-4 border-b border-amber-400/20">
        <a href="{{ route('ads.index') }}" class="text-xs text-amber-700 font-semibold hover:underline">&larr; Back to Campaigns</a>
        <h1 class="text-2xl font-bold font-luxury-title text-slate-900 mt-2">Create Traffic Campaign</h1>
        <p class="text-xs text-slate-500">Configure your text or banner advertisement to receive verified member impressions.</p>
    </div>

    <div class="gold-card p-6">
        <form action="{{ route('ads.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Campaign Title -->
            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Campaign Headline *</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title') }}" 
                    maxlength="100" 
                    required 
                    placeholder="e.g., Prime Sovereign Wealth Advisory" 
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 focus:outline-hidden">
            </div>

            <!-- Ad Format -->
            <div>
                <label for="type" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Format Type *</label>
                <select 
                    id="type" 
                    name="type" 
                    required 
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 focus:outline-hidden">
                    <option value="TEXT" {{ old('type') === 'TEXT' ? 'selected' : '' }}>Text Advertisement</option>
                    <option value="BANNER" {{ old('type') === 'BANNER' ? 'selected' : '' }}>Banner Image Advertisement</option>
                </select>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Campaign Copy / Description *</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="3" 
                    maxlength="1000" 
                    required 
                    placeholder="Highlight your luxury asset, service, or opportunity..." 
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 focus:outline-hidden">{{ old('description') }}</textarea>
            </div>

            <!-- Destination URL -->
            <div>
                <label for="target_url" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Destination Target URL *</label>
                <input 
                    type="url" 
                    id="target_url" 
                    name="target_url" 
                    value="{{ old('target_url') }}" 
                    required 
                    placeholder="https://example.com/exclusive-offer" 
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-mono focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 focus:outline-hidden">
            </div>

            <!-- Banner URL (Optional) -->
            <div>
                <label for="banner_url" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Banner Image URL (Optional)</label>
                <input 
                    type="url" 
                    id="banner_url" 
                    name="banner_url" 
                    value="{{ old('banner_url') }}" 
                    placeholder="https://example.com/banner-728x90.jpg" 
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-mono focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 focus:outline-hidden">
            </div>

            <!-- Initial Credits Allocation -->
            <div class="pt-2">
                <div class="flex items-center justify-between mb-1">
                    <label for="initial_credits" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Initial Credits Allocation</label>
                    <span class="text-xs text-slate-500">Available: {{ number_format($wallet->ad_credits) }} credits</span>
                </div>
                <input 
                    type="number" 
                    id="initial_credits" 
                    name="initial_credits" 
                    min="0" 
                    max="{{ $wallet->ad_credits }}" 
                    value="{{ min(500, $wallet->ad_credits) }}" 
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-mono focus:ring-2 focus:ring-amber-500/30 focus:border-amber-400 focus:outline-hidden">
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3">
                <a href="{{ route('ads.index') }}" class="px-4 py-2.5 rounded-xl text-slate-600 hover:text-slate-900 text-xs font-semibold">Cancel</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl gold-gradient-bg text-white text-xs font-semibold shadow-xs hover:brightness-105 active:scale-95 transition">
                    Publish Campaign
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
