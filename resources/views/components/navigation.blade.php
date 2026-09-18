@php
    $navUser = auth()->user();
    $navWallet = $navUser?->wallet;
@endphp

<header class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-amber-400/20 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18">
            
            <!-- Brand Logo & Prestige Crest -->
            <div class="flex items-center space-x-4">
                <!-- Mobile Hamburger Button -->
                <button 
                    type="button" 
                    id="hamburger-btn" 
                    aria-controls="mobile-sidebar" 
                    aria-expanded="false" 
                    aria-label="Open main navigation"
                    class="lg:hidden p-2 rounded-xl text-slate-700 hover:text-amber-700 hover:bg-amber-50/60 focus:outline-hidden focus:ring-2 focus:ring-amber-500/30 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl gold-gradient-bg flex items-center justify-center shadow-xs ring-2 ring-amber-400/30 group-hover:scale-105 transition-transform">
                        <span class="text-white font-serif font-bold text-xl tracking-wider">A</span>
                    </div>
                    <div>
                        <div class="font-serif font-bold text-xl tracking-widest text-slate-900 leading-none uppercase">Aureus</div>
                        <div class="text-[10px] tracking-widest text-amber-700 uppercase font-semibold">Ad Cycler</div>
                    </div>
                </a>

                <!-- Desktop Navigation Menu -->
                <nav class="hidden lg:flex items-center space-x-1 ml-8">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-amber-50 text-amber-900 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }} transition">Mon Dashboard</a>
                        <a href="{{ route('ad-packs.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('ad-packs.*') ? 'bg-amber-50 text-amber-900 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }} transition">Ad Packs</a>
                        <a href="{{ route('cycler.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('cycler.*') ? 'bg-amber-50 text-amber-900 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }} transition">Cycler Queue</a>
                        <a href="{{ route('ads.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('ads.*') ? 'bg-amber-50 text-amber-900 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }} transition">My Ads</a>
                    @else
                        <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-amber-50 text-amber-900 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }} transition">Accueil</a>
                        <a href="{{ route('home') }}#how-it-works" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100/80 transition">Fonctionnement</a>
                        <a href="{{ route('home') }}#tiers" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100/80 transition">Ad Packs</a>
                    @endauth
                    <a href="{{ route('directory.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('directory.*') ? 'bg-amber-50 text-amber-900 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }} transition">Traffic Directory</a>
                </nav>
            </div>

            <!-- Header Balance Indicators & User Badge -->
            <div class="flex items-center space-x-3">
                @auth
                    <!-- User Name Pill -->
                    <div class="hidden xl:flex items-center px-3 py-1.5 rounded-full bg-slate-50 border border-slate-200/80 text-xs font-medium text-slate-700 max-w-[160px] truncate" title="{{ $navUser->name }}">
                        <span class="w-2 h-2 rounded-full bg-amber-400 mr-2 shrink-0"></span>
                        <span class="truncate">{{ $navUser->name }}</span>
                    </div>

                    @if ($navWallet)
                        <!-- Purchase Balance -->
                        <a href="{{ route('wallet.index') }}" class="hidden sm:flex items-center px-3 py-1.5 rounded-full bg-slate-100 hover:bg-amber-50 border border-slate-200/80 hover:border-amber-300 transition group" title="Purchase Balance">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2"></span>
                            <span class="text-xs text-slate-500 mr-1.5">Pur:</span>
                            <span class="text-xs font-bold text-slate-800 group-hover:text-amber-900">${{ number_format((float) $navWallet->purchase_balance, 2) }}</span>
                        </a>

                        <!-- Earnings Balance -->
                        <a href="{{ route('wallet.index') }}" class="flex items-center px-3 py-1.5 rounded-full bg-amber-50 hover:bg-amber-100/80 border border-amber-300/60 transition group" title="Earnings Balance">
                            <span class="w-2 h-2 rounded-full gold-gradient-bg mr-2"></span>
                            <span class="text-xs text-amber-800/80 mr-1.5 font-medium">Earn:</span>
                            <span class="text-xs font-bold text-amber-900">${{ number_format((float) $navWallet->earnings_balance, 2) }}</span>
                        </a>

                        <!-- Ad Credits Pill -->
                        <a href="{{ route('ads.index') }}" class="hidden md:flex items-center px-3 py-1.5 rounded-full bg-slate-100 hover:bg-amber-50 border border-slate-200/80 hover:border-amber-300 transition group" title="Directory Ad Credits">
                            <span class="text-xs text-slate-500 mr-1.5">Credits:</span>
                            <span class="text-xs font-bold text-slate-800 group-hover:text-amber-900">{{ number_format($navWallet->ad_credits) }}</span>
                        </a>
                    @endif

                    <a href="{{ route('wallet.index') }}" class="px-3 py-1.5 rounded-xl gold-gradient-bg text-white text-xs font-semibold shadow-xs hover:brightness-105 active:scale-95 transition">
                        + Deposit
                    </a>

                    <!-- Desktop Logout Form -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 rounded-xl border border-slate-200 hover:border-amber-300 bg-white hover:bg-amber-50 text-slate-600 hover:text-amber-900 text-xs font-medium transition" title="Déconnexion">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-3.5 py-1.5 rounded-xl border border-amber-400/40 text-amber-900 hover:bg-amber-50 text-xs font-semibold shadow-xs transition">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="px-3.5 py-1.5 rounded-xl gold-gradient-bg text-white text-xs font-semibold shadow-xs hover:brightness-105 active:scale-95 transition">
                        Inscription
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<!-- Accessible Off-Canvas Drawer Backdrop -->
<div id="sidebar-backdrop" class="fixed inset-0 bg-slate-950/40 backdrop-blur-xs z-40 hidden transition-opacity" tabindex="-1"></div>

<!-- Off-Canvas Sidebar Drawer -->
<aside 
    id="mobile-sidebar" 
    aria-label="Mobile Navigation" 
    class="fixed inset-y-0 left-0 w-80 max-w-[85vw] bg-white border-r border-amber-400/20 shadow-2xl z-50 transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col justify-between overflow-y-auto">
    
    <div>
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between p-5 border-b border-amber-400/15">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 rounded-xl gold-gradient-bg flex items-center justify-center text-white font-serif font-bold text-lg">
                    A
                </div>
                <div>
                    <span class="font-serif font-bold text-lg tracking-widest text-slate-900 uppercase">Aureus</span>
                    <span class="block text-[10px] tracking-widest text-amber-700 uppercase font-semibold">Ad Cycler</span>
                </div>
            </div>
            <button 
                type="button" 
                id="sidebar-close-btn" 
                aria-label="Close navigation" 
                class="p-2 rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Sidebar User & Wallet Overview -->
        @auth
            <div class="p-5 bg-amber-50/40 border-b border-amber-400/15">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-8 h-8 rounded-full bg-amber-200 text-amber-900 font-bold text-xs flex items-center justify-center shrink-0">
                        {{ strtoupper(substr($navUser->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <div class="text-xs font-bold text-slate-900 truncate">{{ $navUser->name }}</div>
                        <div class="text-[11px] text-slate-500 truncate">{{ $navUser->email }}</div>
                    </div>
                </div>

                @if ($navWallet)
                    <div class="text-xs font-bold text-amber-800 uppercase tracking-wider mb-2">Ledger Balances</div>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="p-2.5 rounded-lg bg-white border border-amber-200/60">
                            <div class="text-slate-500">Purchase</div>
                            <div class="font-bold text-slate-900 text-sm">${{ number_format((float) $navWallet->purchase_balance, 2) }}</div>
                        </div>
                        <div class="p-2.5 rounded-lg bg-white border border-amber-300/80">
                            <div class="text-amber-800">Earnings</div>
                            <div class="font-bold text-amber-900 text-sm">${{ number_format((float) $navWallet->earnings_balance, 2) }}</div>
                        </div>
                    </div>
                    <div class="mt-2 p-2 rounded-lg bg-white border border-slate-200/80 text-xs flex justify-between items-center">
                        <span class="text-slate-600">Ad Traffic Credits:</span>
                        <span class="font-bold text-slate-900">{{ number_format($navWallet->ad_credits) }}</span>
                    </div>
                @endif
            </div>
        @else
            <div class="p-5 bg-amber-50/40 border-b border-amber-400/15">
                <div class="text-xs font-bold text-amber-800 uppercase tracking-wider mb-1">Aureus Prestige Club</div>
                <p class="text-xs text-slate-600 mb-3">Trafic publicitaire ciblé et file d'attente FIFO automatisée à 150% de rendement.</p>
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('login') }}" class="text-center px-3 py-2 rounded-xl border border-amber-400/50 bg-white text-amber-900 text-xs font-semibold shadow-xs hover:bg-amber-50 transition">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="text-center px-3 py-2 rounded-xl gold-gradient-bg text-white text-xs font-semibold shadow-xs hover:brightness-105 transition">
                        Inscription
                    </a>
                </div>
            </div>
        @endauth

        <!-- Navigation Links -->
        <nav class="p-4 space-y-1">
            @auth
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-amber-50 text-amber-900 font-semibold border border-amber-300/40' : 'text-slate-700 hover:bg-slate-100' }} transition">
                    <svg class="w-5 h-5 mr-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Mon Dashboard
                </a>
                <a href="{{ route('ad-packs.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('ad-packs.*') ? 'bg-amber-50 text-amber-900 font-semibold border border-amber-300/40' : 'text-slate-700 hover:bg-slate-100' }} transition">
                    <svg class="w-5 h-5 mr-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Purchase Ad Packs
                </a>
                <a href="{{ route('cycler.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('cycler.*') ? 'bg-amber-50 text-amber-900 font-semibold border border-amber-300/40' : 'text-slate-700 hover:bg-slate-100' }} transition">
                    <svg class="w-5 h-5 mr-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    FIFO Cycler Queue
                </a>
                <a href="{{ route('ads.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('ads.*') ? 'bg-amber-50 text-amber-900 font-semibold border border-amber-300/40' : 'text-slate-700 hover:bg-slate-100' }} transition">
                    <svg class="w-5 h-5 mr-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    My Campaigns
                </a>
                <a href="{{ route('wallet.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('wallet.*') ? 'bg-amber-50 text-amber-900 font-semibold border border-amber-300/40' : 'text-slate-700 hover:bg-slate-100' }} transition">
                    <svg class="w-5 h-5 mr-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Wallet & Ledger
                </a>
            @else
                <a href="{{ route('home') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('home') ? 'bg-amber-50 text-amber-900 font-semibold border border-amber-300/40' : 'text-slate-700 hover:bg-slate-100' }} transition">
                    <svg class="w-5 h-5 mr-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Accueil
                </a>
                <a href="{{ route('home') }}#how-it-works" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-100 transition">
                    <svg class="w-5 h-5 mr-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Fonctionnement
                </a>
                <a href="{{ route('home') }}#tiers" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-100 transition">
                    <svg class="w-5 h-5 mr-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Ad Packs Tiers
                </a>
            @endauth
            <a href="{{ route('directory.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('directory.*') ? 'bg-amber-50 text-amber-900 font-semibold border border-amber-300/40' : 'text-slate-700 hover:bg-slate-100' }} transition">
                <svg class="w-5 h-5 mr-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Traffic Directory
            </a>
        </nav>
    </div>

    <!-- Sidebar Bottom Utilities & Mobile Logout -->
    <div class="p-4 border-t border-slate-100 space-y-3">
        @auth
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl border border-rose-200 bg-rose-50/50 hover:bg-rose-100/80 text-rose-700 text-xs font-semibold transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        @endauth

        @if (app()->isLocal())
            <a href="{{ route('browser.showcase') }}" class="flex items-center justify-between p-3 rounded-xl bg-amber-50 border border-amber-200 text-xs font-semibold text-amber-900 hover:bg-amber-100 transition">
                <span>UI Component Atlas</span>
                <span class="px-1.5 py-0.5 rounded-full bg-amber-200 text-amber-900 text-[10px]">/browser</span>
            </a>
        @endif
        <div class="text-[11px] text-center text-slate-400">
            Aureus Prestige Engine v1.0
        </div>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const sidebar = document.getElementById('mobile-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        const closeBtn = document.getElementById('sidebar-close-btn');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
            hamburgerBtn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
            closeBtn.focus();
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
            hamburgerBtn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
            hamburgerBtn.focus();
        }

        if (hamburgerBtn) hamburgerBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (backdrop) backdrop.addEventListener('click', closeSidebar);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
                closeSidebar();
            }
        });
    });
</script>
