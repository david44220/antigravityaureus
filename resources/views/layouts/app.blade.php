<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aureus Ad Cycler') }} - @yield('title', 'Luxury Ad Cycler')</title>

    <!-- Google Fonts: Cormorant Garamond & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:600,700|plus-jakarta-sans:400,500,600,700" rel="stylesheet" />

    <style>
        :root {
            --font-serif: 'Cormorant Garamond', Georgia, serif;
            --font-sans: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
        body {
            font-family: var(--font-sans);
            color: #0F172A;
            background-color: #F8FAFC;
        }
        .font-luxury-title {
            font-family: var(--font-serif);
            letter-spacing: -0.02em;
        }
        .gold-gradient-text {
            background: linear-gradient(135deg, #D4AF37 0%, #F3E8C4 50%, #B38F2E 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gold-gradient-bg {
            background: linear-gradient(135deg, #D4AF37 0%, #C5A059 50%, #B38F2E 100%);
        }
        .gold-border {
            border-color: rgba(212, 175, 55, 0.25);
        }
        .gold-card {
            background: #FFFFFF;
            border: 1px solid rgba(212, 175, 55, 0.20);
            box-shadow: 0 4px 20px -2px rgba(212, 175, 55, 0.05), 0 2px 6px -1px rgba(15, 23, 42, 0.04);
            border-radius: 1rem;
        }
        .gold-card:hover {
            border-color: rgba(212, 175, 55, 0.40);
            box-shadow: 0 8px 30px -4px rgba(212, 175, 55, 0.12), 0 4px 10px -2px rgba(15, 23, 42, 0.06);
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex flex-col antialiased text-slate-900 bg-slate-50 overflow-x-hidden selection:bg-amber-100 selection:text-amber-900">

    <!-- Top Navigation & Off-Canvas Drawer -->
    @include('components.navigation')

    <!-- Flash Status Messages -->
    @if (session('status'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 w-full">
            <div class="p-4 rounded-xl bg-amber-50/80 border border-amber-300/60 shadow-xs flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <span class="p-1 rounded-full bg-amber-200/60 text-amber-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </span>
                    <p class="text-sm font-medium text-amber-900">{{ session('status') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-amber-700 hover:text-amber-900 text-sm font-bold ml-4">✕</button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 w-full">
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 shadow-xs">
                <div class="flex items-center space-x-2 text-rose-800 font-semibold text-sm mb-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Please correct the following errors:</span>
                </div>
                <ul class="list-disc list-inside text-xs text-rose-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Main Content Body -->
    <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Luxury Minimalist Footer -->
    <footer class="bg-white border-t border-amber-400/20 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div class="flex items-center space-x-2">
                <span class="w-4 h-4 rounded-full gold-gradient-bg inline-block"></span>
                <span class="font-serif tracking-widest text-slate-900 font-bold uppercase text-sm">Aureus Ad Cycler</span>
                <span class="text-slate-400">|</span>
                <span>White & Gold Prestige Platform</span>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{ route('directory.index') }}" class="hover:text-amber-700 transition">Traffic Directory</a>
                <a href="{{ route('ad-packs.index') }}" class="hover:text-amber-700 transition">Packs Catalog</a>
                @if (app()->isLocal())
                    <a href="{{ route('browser.showcase') }}" class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 font-semibold hover:bg-amber-200 transition">/browser atlas</a>
                @endif
                <span>&copy; {{ date('Y') }} Aureus Global. All rights reserved.</span>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
