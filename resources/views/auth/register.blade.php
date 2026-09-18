@extends('layouts.app')

@section('title', 'Inscription Investisseur')

@section('content')
<div class="min-h-[70vh] flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <!-- Prestige Header Emblem -->
        <div class="text-center mb-8">
            <div class="inline-flex w-14 h-14 rounded-2xl gold-gradient-bg items-center justify-center shadow-md ring-4 ring-amber-400/20 mb-4">
                <span class="text-white font-serif font-bold text-2xl tracking-wider">A</span>
            </div>
            <h1 class="text-3xl font-bold font-luxury-title text-slate-900 tracking-tight">Devenir Membre</h1>
            <p class="mt-2 text-xs uppercase tracking-widest text-amber-700 font-semibold">Adhésion Aureus Prestige Club</p>
        </div>

        <!-- Luxury Register Card -->
        <div class="gold-card p-8 sm:p-10 border-amber-400/30 shadow-lg">
            <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Nom Complet / Raison Sociale
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus 
                            autocomplete="name"
                            placeholder="Alexander Sterling"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-amber-500/30 focus:border-[#D4AF37] focus:outline-hidden transition"
                        >
                    </div>
                </div>

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
                            autocomplete="username"
                            placeholder="investisseur@aureus.luxury"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-amber-500/30 focus:border-[#D4AF37] focus:outline-hidden transition"
                        >
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Mot de passe (Min. 8 caractères, majuscule, minuscule, chiffre)
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            placeholder="••••••••••••"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-amber-500/30 focus:border-[#D4AF37] focus:outline-hidden transition"
                        >
                    </div>
                </div>

                <!-- Password Confirmation Field -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Confirmer le mot de passe
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            placeholder="••••••••••••"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50/70 border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-amber-500/30 focus:border-[#D4AF37] focus:outline-hidden transition"
                        >
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button 
                        type="submit" 
                        class="w-full py-3.5 px-4 rounded-xl gold-gradient-bg text-white font-semibold text-sm tracking-wide shadow-md hover:brightness-105 active:scale-[0.99] transition duration-150 flex items-center justify-center space-x-2"
                    >
                        <span>Créer Mon Compte</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-500">
                    Déjà membre accrédité ? 
                    <a href="{{ route('login') }}" class="font-bold text-amber-700 hover:text-amber-800 hover:underline ml-1">
                        Se connecter &rarr;
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
