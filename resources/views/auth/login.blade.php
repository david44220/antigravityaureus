@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="min-h-[70vh] flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <!-- Prestige Header Emblem -->
        <div class="text-center mb-8">
            <div class="inline-flex w-14 h-14 rounded-2xl gold-gradient-bg items-center justify-center shadow-md ring-4 ring-amber-400/20 mb-4">
                <span class="text-white font-serif font-bold text-2xl tracking-wider">A</span>
            </div>
            <h1 class="text-3xl font-bold font-luxury-title text-slate-900 tracking-tight">Accès Investisseur</h1>
            <p class="mt-2 text-xs uppercase tracking-widest text-amber-700 font-semibold">Plateforme Sécurisée Aureus Prestige</p>
        </div>

        <!-- Luxury Login Card -->
        <div class="gold-card p-8 sm:p-10 border-amber-400/30 shadow-lg">
            <form action="{{ route('login.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Adresse E-mail
                    </label>
                    <div class="relative">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="investisseur@aureus.luxury"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-amber-500/30 focus:border-[#D4AF37] focus:outline-hidden transition"
                        >
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                            Mot de passe
                        </label>
                    </div>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="••••••••••••"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-amber-500/30 focus:border-[#D4AF37] focus:outline-hidden transition"
                        >
                    </div>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center space-x-2.5 cursor-pointer select-none">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember" 
                            value="1" 
                            {{ old('remember') ? 'checked' : '' }}
                            class="w-4 h-4 rounded text-amber-600 border-slate-300 focus:ring-amber-500/40"
                        >
                        <span class="text-xs text-slate-600">Se souvenir de moi</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full py-3.5 px-4 rounded-xl gold-gradient-bg text-white font-semibold text-sm tracking-wide shadow-md hover:brightness-105 active:scale-[0.99] transition duration-150 flex items-center justify-center space-x-2"
                    >
                        <span>Se Connecter</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>

            @if (app()->isLocal())
                <!-- Local Environment Demo Auto-Fill Assistance -->
                <div class="mt-6 pt-5 border-t border-amber-400/20 text-center">
                    <button 
                        type="button" 
                        onclick="document.getElementById('email').value='demo@aureus.test'; document.getElementById('password').value='password';"
                        class="inline-flex items-center px-3 py-1.5 rounded-lg bg-amber-50 border border-amber-300/60 text-[11px] font-semibold text-amber-900 hover:bg-amber-100/80 transition"
                    >
                        <svg class="w-3.5 h-3.5 mr-1.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Remplir identifiants Démo (demo@aureus.test / password)
                    </button>
                </div>
            @endif

            <!-- Registration Link -->
            <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-500">
                    Pas encore membre de notre club ? 
                    <a href="{{ route('register') }}" class="font-bold text-amber-700 hover:text-amber-800 hover:underline ml-1">
                        Créer un compte &rarr;
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
