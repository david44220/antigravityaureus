@extends('layouts.app')

@section('title', 'Local Component Atlas (/browser)')

@section('content')
<div class="space-y-12">

    <!-- Showcase Environment Banner -->
    <div class="p-6 rounded-2xl bg-gradient-to-r from-amber-500/15 via-yellow-500/10 to-amber-500/15 border border-amber-400/30 shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center space-x-2">
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-200 text-amber-900 uppercase tracking-wider">Local Atlas Gated</span>
                    <span class="text-xs text-slate-500 font-mono">abort_unless(app()->isLocal(), 403)</span>
                </div>
                <h1 class="text-2xl lg:text-3xl font-bold font-luxury-title text-slate-900 mt-1">Aureus Luxury Design System & Component Atlas</h1>
                <p class="text-xs text-slate-600 mt-0.5">Comprehensive visual testing grounds for color tokens, typography, accessible navigation, and interactive domain widgets.</p>
            </div>
            <button 
                type="button" 
                onclick="document.getElementById('hamburger-btn').click()" 
                class="px-4 py-2 rounded-xl gold-gradient-bg text-white text-xs font-semibold shadow-xs hover:brightness-105 active:scale-95 transition shrink-0">
                Test Hamburger Drawer &rarr;
            </button>
        </div>
    </div>

    <!-- Section 1: White & Gold Luxury Design Tokens -->
    <section class="space-y-4">
        <div class="border-b border-amber-400/20 pb-2">
            <h2 class="text-xl font-bold font-luxury-title text-slate-900">1. Color Tokens & Luxury Palette Swatches</h2>
            <p class="text-xs text-slate-500">Curated high-contrast luxury pairing meeting WCAG AAA specifications.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-3">
            <!-- Diamond White -->
            <div class="p-3 rounded-xl bg-white border border-slate-200 shadow-xs text-center">
                <div class="w-full h-12 rounded-lg bg-white border border-slate-200 mb-2"></div>
                <div class="text-xs font-bold text-slate-900">Pure White</div>
                <div class="text-[10px] font-mono text-slate-400">#FFFFFF</div>
            </div>
            <!-- Light Slate Background -->
            <div class="p-3 rounded-xl bg-white border border-slate-200 shadow-xs text-center">
                <div class="w-full h-12 rounded-lg bg-slate-50 border border-slate-200 mb-2"></div>
                <div class="text-xs font-bold text-slate-900">Light Slate</div>
                <div class="text-[10px] font-mono text-slate-400">#F8FAFC</div>
            </div>
            <!-- Subtle Muted Border -->
            <div class="p-3 rounded-xl bg-white border border-slate-200 shadow-xs text-center">
                <div class="w-full h-12 rounded-lg bg-slate-100 border border-slate-200 mb-2"></div>
                <div class="text-xs font-bold text-slate-900">Muted Slate</div>
                <div class="text-[10px] font-mono text-slate-400">#F1F5F9</div>
            </div>
            <!-- Champagne Gold -->
            <div class="p-3 rounded-xl bg-white border border-amber-300 shadow-xs text-center">
                <div class="w-full h-12 rounded-lg mb-2" style="background-color: #D4AF37;"></div>
                <div class="text-xs font-bold text-slate-900">Champagne</div>
                <div class="text-[10px] font-mono text-amber-700">#D4AF37</div>
            </div>
            <!-- Metallic Gold -->
            <div class="p-3 rounded-xl bg-white border border-amber-300 shadow-xs text-center">
                <div class="w-full h-12 rounded-lg mb-2" style="background-color: #C5A059;"></div>
                <div class="text-xs font-bold text-slate-900">Metallic Gold</div>
                <div class="text-[10px] font-mono text-amber-700">#C5A059</div>
            </div>
            <!-- Antique Gold Accent -->
            <div class="p-3 rounded-xl bg-white border border-amber-400 shadow-xs text-center">
                <div class="w-full h-12 rounded-lg mb-2" style="background-color: #8C6D23;"></div>
                <div class="text-xs font-bold text-white bg-slate-800 rounded-sm">Antique Gold</div>
                <div class="text-[10px] font-mono text-amber-800">#8C6D23</div>
            </div>
            <!-- Deep Obsidian Charcoal -->
            <div class="p-3 rounded-xl bg-white border border-slate-200 shadow-xs text-center">
                <div class="w-full h-12 rounded-lg bg-slate-900 mb-2"></div>
                <div class="text-xs font-bold text-slate-900">Obsidian Slate</div>
                <div class="text-[10px] font-mono text-slate-400">#0F172A</div>
            </div>
            <!-- Luxury Gold Gradient -->
            <div class="p-3 rounded-xl bg-white border border-amber-300 shadow-xs text-center">
                <div class="w-full h-12 rounded-lg gold-gradient-bg mb-2 shadow-xs"></div>
                <div class="text-xs font-bold text-slate-900">Gold Gradient</div>
                <div class="text-[10px] font-mono text-amber-700">Multi-Stop</div>
            </div>
        </div>
    </section>

    <!-- Section 2: Typography Scale -->
    <section class="space-y-4">
        <div class="border-b border-amber-400/20 pb-2">
            <h2 class="text-xl font-bold font-luxury-title text-slate-900">2. Typography Hierarchy & Contrast Scales</h2>
            <p class="text-xs text-slate-500">Dual font pairing: Cormorant Garamond (Editorial Serif) & Plus Jakarta Sans (Precision Body).</p>
        </div>

        <div class="gold-card p-6 space-y-4">
            <div>
                <span class="text-[10px] uppercase tracking-widest text-amber-700 font-bold">Display Title (Serif - 32px)</span>
                <div class="text-3xl font-bold font-luxury-title text-slate-900">Aureus Ad Cycler & Capital Exchange</div>
            </div>
            <div class="pt-2 border-t border-slate-100">
                <span class="text-[10px] uppercase tracking-widest text-amber-700 font-bold">Section Heading H2 (Serif - 22px)</span>
                <h2 class="text-xl font-bold font-luxury-title text-slate-900">First-In, First-Out Queue Resolution Protocol</h2>
            </div>
            <div class="pt-2 border-t border-slate-100">
                <span class="text-[10px] uppercase tracking-widest text-amber-700 font-bold">Standard Body Copy (Sans - 14px)</span>
                <p class="text-sm text-slate-600 leading-relaxed max-w-2xl">
                    Every advertising pack acquired on the platform immediately credits verified directory impressions to your account while assigning you a position in the queue. When required downstream positions accumulate, automated 150% ROI payouts settle directly to your earnings balance.
                </p>
            </div>
            <div class="pt-2 border-t border-slate-100">
                <span class="text-[10px] uppercase tracking-widest text-amber-700 font-bold">Financial Telemetry & Monospace (Mono - 13px)</span>
                <div class="font-mono text-xs text-slate-800 bg-slate-50 p-2.5 rounded-lg border border-slate-200">
                    TX_HASH: 583bb28772a676c0eb91a4d63ee032465c4305668b95d553cba99cac7b33f5b1 | BAL_AFTER: $1,250.00
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Interactive Pack Cards Preview -->
    <section class="space-y-4">
        <div class="border-b border-amber-400/20 pb-2">
            <h2 class="text-xl font-bold font-luxury-title text-slate-900">3. Sample Ad Pack Tier Cards</h2>
            <p class="text-xs text-slate-500">Realistic mock tier cards rendered directly with pricing, impressions, and payout formulas.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($tiers as $tier)
                <div class="gold-card p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full gold-gradient-bg"></span>
                            <h3 class="font-serif font-bold text-lg text-slate-900">{{ $tier->name }}</h3>
                        </div>
                        <div class="mt-3 flex items-baseline space-x-1">
                            <span class="text-3xl font-bold font-mono text-slate-900">${{ number_format((float) $tier->price, 2) }}</span>
                            <span class="text-xs text-slate-500">/ pack</span>
                        </div>
                        <div class="mt-4 space-y-2 text-xs border-t border-slate-100 pt-4">
                            <div class="flex justify-between text-slate-600">
                                <span>Ad Impressions:</span>
                                <span class="font-mono font-bold text-slate-900">{{ number_format($tier->ad_credits_awarded) }}</span>
                            </div>
                            <div class="flex justify-between text-slate-600">
                                <span>Required Downstream:</span>
                                <span class="font-mono font-bold text-slate-900">{{ $tier->required_downstream }}</span>
                            </div>
                            <div class="flex justify-between text-slate-600">
                                <span>Payout Upon Cycle:</span>
                                <span class="font-mono font-bold text-emerald-700">${{ number_format((float) $tier->payout_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <button type="button" class="w-full py-2.5 rounded-xl gold-gradient-bg text-white text-xs font-semibold shadow-xs hover:brightness-105 transition">
                            Sample Buy Trigger
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Section 4: FIFO Queue Step Visualizer -->
    <section class="space-y-4">
        <div class="border-b border-amber-400/20 pb-2">
            <h2 class="text-xl font-bold font-luxury-title text-slate-900">4. FIFO Queue Progress Card Visualizer</h2>
            <p class="text-xs text-slate-500">Simulates active queue states from 0/2 positions accumulated to cycled completion.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- 0 / 2 Position -->
            <div class="gold-card p-5">
                <div class="flex justify-between items-center text-xs">
                    <span class="font-serif font-bold text-slate-900">Aurum Tier I #101</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">Step 0/2</span>
                </div>
                <div class="mt-3">
                    <div class="flex justify-between text-xs text-slate-500 mb-1">
                        <span>Progress</span>
                        <span class="font-mono">0%</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-slate-100 overflow-hidden border border-slate-200">
                        <div class="h-full gold-gradient-bg" style="width: 0%"></div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <span class="text-[11px] text-amber-800 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200">Waiting for 2 downstream positions</span>
                </div>
            </div>

            <!-- 1 / 2 Position -->
            <div class="gold-card p-5 border-amber-300">
                <div class="flex justify-between items-center text-xs">
                    <span class="font-serif font-bold text-slate-900">Aurum Tier II #102</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-900 border border-amber-300">Step 1/2</span>
                </div>
                <div class="mt-3">
                    <div class="flex justify-between text-xs text-slate-500 mb-1">
                        <span>Progress</span>
                        <span class="font-mono">50%</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-slate-100 overflow-hidden border border-slate-200">
                        <div class="h-full gold-gradient-bg" style="width: 50%"></div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <span class="text-[11px] text-amber-800 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200 font-semibold">1 position accumulated!</span>
                </div>
            </div>

            <!-- 2 / 2 Cycled Position -->
            <div class="gold-card p-5 border-emerald-300 bg-gradient-to-b from-white to-emerald-50/20">
                <div class="flex justify-between items-center text-xs">
                    <span class="font-serif font-bold text-slate-900">Aurum Tier III #103</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-900 border border-emerald-300">CYCLED</span>
                </div>
                <div class="mt-3">
                    <div class="flex justify-between text-xs text-slate-500 mb-1">
                        <span>Progress</span>
                        <span class="font-mono text-emerald-700 font-bold">100% (Completed)</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-slate-100 overflow-hidden border border-slate-200">
                        <div class="h-full bg-emerald-500" style="width: 100%"></div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <span class="text-[11px] text-emerald-800 bg-emerald-100 px-3 py-1 rounded-full font-bold">+$75.00 Payout Settled</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Directory Ad Previews -->
    <section class="space-y-4">
        <div class="border-b border-amber-400/20 pb-2">
            <h2 class="text-xl font-bold font-luxury-title text-slate-900">5. Traffic Directory Campaign Cards</h2>
            <p class="text-xs text-slate-500">Responsive preview of member text and banner advertisements.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($mockAds as $ad)
                <div class="gold-card p-5 flex flex-col justify-between">
                    <div>
                        @if ($ad->type === 'BANNER' && $ad->banner_url)
                            <div class="w-full h-32 rounded-xl overflow-hidden mb-3 border border-slate-200 bg-slate-100">
                                <img src="{{ $ad->banner_url }}" alt="{{ $ad->title }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="flex items-center space-x-2 mb-1.5">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $ad->type === 'BANNER' ? 'bg-indigo-50 text-indigo-800' : 'bg-amber-50 text-amber-800' }}">{{ $ad->type }}</span>
                            <span class="text-[10px] text-slate-400 font-mono">{{ $ad->credits_allocated }} impressions remaining</span>
                        </div>
                        <h3 class="font-serif font-bold text-base text-slate-900">{{ $ad->title }}</h3>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $ad->description }}</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[11px] font-mono text-slate-400">{{ $ad->clicks }} visits recorded</span>
                        <a href="{{ $ad->target_url }}" target="_blank" class="px-3 py-1.5 rounded-lg gold-gradient-bg text-white text-xs font-semibold hover:brightness-105 transition">
                            Visit Site &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</div>
@endsection
