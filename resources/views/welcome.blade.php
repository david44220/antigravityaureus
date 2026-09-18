@extends('layouts.app')

@section('title', 'Accueil - Prestige Publicitaire & Cycler FIFO 150%')

@section('content')
<div class="space-y-20 sm:space-y-28 py-6">

    <!-- Hero Section -->
    <section class="relative overflow-hidden pt-6 pb-12 sm:pt-12 sm:pb-16 text-center">
        <!-- Subtle Luxury Gold Radial Glow -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-amber-200/25 via-amber-100/10 to-transparent rounded-full blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <!-- Prestige Badge -->
            <div class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full bg-amber-50 border border-amber-300/60 shadow-xs mb-8">
                <span class="w-2 h-2 rounded-full gold-gradient-bg animate-pulse"></span>
                <span class="text-xs font-semibold uppercase tracking-widest text-amber-900">Moteur FIFO Haute Fidélité &bull; ROI Certifié 150%</span>
            </div>

            <!-- Main Heading -->
            <h1 class="font-luxury-title text-4xl sm:text-6xl lg:text-7xl font-bold text-slate-900 leading-[1.1] mb-6">
                L'Harmonie du <span class="gold-gradient-text">Trafic Premium</span> & du Rendement Cyclique.
            </h1>

            <!-- Subtitle -->
            <p class="text-lg sm:text-xl text-slate-600 max-w-2xl mx-auto mb-10 leading-relaxed font-normal">
                Propulsez vos campagnes publicitaires sur notre annuaire d'élite tout en participant à un système cycler FIFO mathématiquement équitable et audité.
            </p>

            <!-- Dual Action CTAs -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl gold-gradient-bg text-white font-semibold text-sm shadow-md hover:brightness-105 active:scale-95 transition flex items-center justify-center space-x-2">
                        <span>Accéder à Mon Dashboard</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="{{ route('ad-packs.index') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-white border border-amber-300/80 text-amber-900 font-semibold text-sm shadow-xs hover:bg-amber-50/60 active:scale-95 transition">
                        Acheter des Ad Packs
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl gold-gradient-bg text-white font-semibold text-sm shadow-md hover:brightness-105 active:scale-95 transition flex items-center justify-center space-x-2">
                        <span>Rejoindre & Tester la Démo</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="{{ route('directory.index') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-white border border-amber-300/80 text-amber-900 font-semibold text-sm shadow-xs hover:bg-amber-50/60 active:scale-95 transition">
                        Consulter l'Annuaire Public
                    </a>
                @endauth
            </div>

            <!-- Trust Key Figures -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-16 pt-12 border-t border-amber-400/20">
                <div class="p-4 rounded-xl bg-white/80 border border-amber-200/50 shadow-xs">
                    <div class="font-luxury-title text-3xl sm:text-4xl font-bold gold-gradient-text">150%</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider mt-1 font-medium">Rendement par Cycle</div>
                </div>
                <div class="p-4 rounded-xl bg-white/80 border border-amber-200/50 shadow-xs">
                    <div class="font-luxury-title text-3xl sm:text-4xl font-bold text-slate-900">FIFO Strict</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider mt-1 font-medium">File Chronologique Pure</div>
                </div>
                <div class="p-4 rounded-xl bg-white/80 border border-amber-200/50 shadow-xs">
                    <div class="font-luxury-title text-3xl sm:text-4xl font-bold text-slate-900">Double-Entry</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider mt-1 font-medium">Grand-Livre Immuable</div>
                </div>
                <div class="p-4 rounded-xl bg-white/80 border border-amber-200/50 shadow-xs">
                    <div class="font-luxury-title text-3xl sm:text-4xl font-bold text-emerald-600">Instantané</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider mt-1 font-medium">Paiement Automatique</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3-Step Mechanics Section -->
    <section id="how-it-works" class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-700 block mb-2">Ingénierie Algorithmique</span>
            <h2 class="font-luxury-title text-3xl sm:text-5xl font-bold text-slate-900">
                Une Mécanique Transparente en 3 Temps
            </h2>
            <p class="text-slate-600 mt-4 text-base">
                L'algorithme FIFO Aureus garantit une équité absolue. Aucune manipulation, aucune priorité cachée : le premier entré est le premier servi.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            <!-- Step 1 -->
            <div class="gold-card p-8 relative flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl gold-gradient-bg flex items-center justify-center text-white font-serif font-bold text-xl mb-6 shadow-xs">
                        1
                    </div>
                    <h3 class="font-luxury-title text-2xl font-bold text-slate-900 mb-3">
                        Acquisition de Pack Publicitaire
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-6">
                        Choisissez votre palier ($10, $25 ou $50). Dès validation, vous recevez instantanément des crédits de trafic qualifié pour diffuser vos bannières et liens d'affiliation sur notre annuaire public.
                    </p>
                </div>
                <div class="pt-4 border-t border-amber-100 flex items-center text-xs font-semibold text-amber-800">
                    <svg class="w-4 h-4 mr-1.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Crédits publicitaires crédités à la seconde
                </div>
            </div>

            <!-- Step 2 -->
            <div class="gold-card p-8 relative flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl gold-gradient-bg flex items-center justify-center text-white font-serif font-bold text-xl mb-6 shadow-xs">
                        2
                    </div>
                    <h3 class="font-luxury-title text-2xl font-bold text-slate-900 mb-3">
                        Entrée dans la File FIFO Dédiée
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-6">
                        Chaque achat attribue une position horodatée unique dans la file d'attente de son palier. Votre statut progresse automatiquement à mesure que la communauté investit dans la même file.
                    </p>
                </div>
                <div class="pt-4 border-t border-amber-100 flex items-center text-xs font-semibold text-amber-800">
                    <svg class="w-4 h-4 mr-1.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Verrouillage pessimiste atomique (Row-Lock)
                </div>
            </div>

            <!-- Step 3 -->
            <div class="gold-card p-8 relative flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl gold-gradient-bg flex items-center justify-center text-white font-serif font-bold text-xl mb-6 shadow-xs">
                        3
                    </div>
                    <h3 class="font-luxury-title text-2xl font-bold text-slate-900 mb-3">
                        Cycle & Versement ROI 150%
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-6">
                        Dès que la file atteint le seuil requis de nouveaux packs, la position en tête cycle instantanément. Un virement automatique de 150% de la valeur faciale est crédité sur votre solde de gains.
                    </p>
                </div>
                <div class="pt-4 border-t border-amber-100 flex items-center text-xs font-semibold text-amber-800">
                    <svg class="w-4 h-4 mr-1.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Rendement net disponible pour retrait ou réinvestissement
                </div>
            </div>
        </div>
    </section>

    <!-- Ad Pack Tiers Showcase Grid -->
    <section id="tiers" class="max-w-7xl mx-auto px-4 sm:px-6 pt-6">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-700 block mb-2">Catalogue Officiel</span>
            <h2 class="font-luxury-title text-3xl sm:text-5xl font-bold text-slate-900">
                Nos Paliers Publicitaires & Cyclers
            </h2>
            <p class="text-slate-600 mt-4 text-base">
                Sélectionnez le niveau de puissance marketing et de vélocité financière adapté à vos objectifs.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            @forelse ($tiers as $tier)
                @php
                    $isTopTier = $loop->last;
                @endphp
                <div class="gold-card p-6 sm:p-8 relative flex flex-col justify-between overflow-hidden transition-all duration-300 {{ $isTopTier ? 'ring-2 ring-amber-400/60 shadow-lg' : '' }}">
                    @if ($isTopTier)
                        <div class="absolute top-0 right-0 bg-gradient-to-l from-amber-500 to-yellow-500 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-bl-xl shadow-xs">
                            Prestige Élite
                        </div>
                    @endif

                    <div>
                        <!-- Card Header -->
                        <div class="flex items-center justify-between mb-4 pr-16">
                            <div class="flex items-center space-x-2">
                                <span class="w-2.5 h-2.5 rounded-full gold-gradient-bg shrink-0"></span>
                                <h3 class="font-luxury-title text-2xl font-bold text-slate-900 leading-tight">{{ $tier->name }}</h3>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs text-slate-500">File FIFO Tier {{ $tier->id }}</span>
                            <span class="px-2.5 py-0.5 rounded-lg bg-amber-50 text-amber-900 font-bold text-xs border border-amber-300/60">
                                150% ROI
                            </span>
                        </div>

                        <!-- Pricing & Payout -->
                        <div class="my-5 pb-5 border-b border-amber-100">
                            <div class="flex items-baseline space-x-1">
                                <span class="font-mono text-4xl sm:text-5xl font-bold text-slate-900">${{ number_format((float) $tier->price, 2) }}</span>
                                <span class="text-xs text-slate-500 uppercase font-medium">/ pack</span>
                            </div>
                            <div class="mt-2 text-xs font-semibold text-emerald-700 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                Gain garanti au cycle : ${{ number_format((float) $tier->payout_amount, 2) }}
                            </div>
                        </div>

                        <!-- Pack Perks List -->
                        <ul class="space-y-3 text-xs text-slate-700 mb-8">
                            <li class="flex items-center space-x-2.5">
                                <div class="w-5 h-5 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center shrink-0">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span><strong class="text-slate-900 font-bold font-mono">{{ number_format($tier->ad_credits_awarded) }}</strong> crédits de diffusion</span>
                            </li>
                            <li class="flex items-center space-x-2.5">
                                <div class="w-5 h-5 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center shrink-0">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span>1 Position horodatée dans la file FIFO</span>
                            </li>
                            <li class="flex items-center space-x-2.5">
                                <div class="w-5 h-5 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center shrink-0">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span>Seuil de cycle : <strong class="text-slate-900 font-bold font-mono">{{ $tier->required_downstream }}</strong> positions</span>
                            </li>
                            <li class="flex items-center space-x-2.5">
                                <div class="w-5 h-5 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center shrink-0">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span>Suivi télémétrique des clics en direct</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Card Button -->
                    <div class="pt-4 border-t border-slate-100">
                        @auth
                            <a href="{{ route('ad-packs.index') }}" class="block w-full py-3 px-4 text-center rounded-xl {{ $isTopTier ? 'gold-gradient-bg text-white shadow-md hover:brightness-105' : 'bg-amber-50 text-amber-900 border border-amber-300 hover:bg-amber-100/80' }} font-semibold text-xs uppercase tracking-wider transition">
                                Acquérir ce Pack
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="block w-full py-3 px-4 text-center rounded-xl {{ $isTopTier ? 'gold-gradient-bg text-white shadow-md hover:brightness-105' : 'bg-amber-50 text-amber-900 border border-amber-300 hover:bg-amber-100/80' }} font-semibold text-xs uppercase tracking-wider transition">
                                S'inscrire & Investir
                            </a>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-3 p-8 text-center bg-white rounded-xl border border-amber-200">
                    <p class="text-sm text-slate-500">Aucun palier publicitaire actif pour le moment.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Trust, AppSec & Architecture Highlights -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="rounded-3xl p-8 sm:p-12 shadow-xl relative overflow-hidden text-white" style="background: linear-gradient(135deg, #0B1120 0%, #1E293B 50%, #0B1120 100%);">
            <div class="absolute -right-16 -bottom-16 w-80 h-80 rounded-full blur-3xl pointer-events-none" style="background: rgba(212, 175, 55, 0.15);"></div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center relative z-10">
                <div class="lg:col-span-1">
                    <div class="w-12 h-12 rounded-xl gold-gradient-bg flex items-center justify-center text-white font-serif font-bold text-xl mb-4 shadow-sm">
                        A
                    </div>
                    <h3 class="font-luxury-title text-3xl font-bold mb-3 text-white">
                        Garantie Cryptographique & Résilience
                    </h3>
                    <p class="text-xs leading-relaxed text-slate-300">
                        Chaque mouvement de fonds est protégé au niveau de la base de données par des verrous de ligne exclusifs (pessimistic row-locking) empêchant toute double-dépense ou divergence de concurrence.
                    </p>
                </div>

                <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div class="p-5 rounded-2xl border" style="background: rgba(15, 23, 42, 0.7); border-color: rgba(212, 175, 55, 0.2);">
                        <div class="font-bold text-amber-300 mb-1.5 flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 inline-block"></span>
                            <span>Transactions Atomiques</span>
                        </div>
                        <p class="text-slate-300 leading-relaxed">
                            Les transferts, achats de packs et résolutions de cycles s'exécutent au sein de transactions SQL isolées. En cas d'anomalie, un rollback automatique est opéré.
                        </p>
                    </div>

                    <div class="p-5 rounded-2xl border" style="background: rgba(15, 23, 42, 0.7); border-color: rgba(212, 175, 55, 0.2);">
                        <div class="font-bold text-amber-300 mb-1.5 flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 inline-block"></span>
                            <span>Grand-Livre Double-Entrée</span>
                        </div>
                        <p class="text-slate-300 leading-relaxed">
                            Distinction stricte entre le solde de dépôt (purchase balance) et le solde de rémunération (earnings balance), avec audit trail complet.
                        </p>
                    </div>

                    <div class="p-5 rounded-2xl border" style="background: rgba(15, 23, 42, 0.7); border-color: rgba(212, 175, 55, 0.2);">
                        <div class="font-bold text-amber-300 mb-1.5 flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 inline-block"></span>
                            <span>Équité Mathématique FIFO</span>
                        </div>
                        <p class="text-slate-300 leading-relaxed">
                            Priorité d'attribution déterminée exclusivement par l'horodatage nanoseconde d'entrée dans la file, sans passe-droit ni privilège opérateur.
                        </p>
                    </div>

                    <div class="p-5 rounded-2xl border" style="background: rgba(15, 23, 42, 0.7); border-color: rgba(212, 175, 55, 0.2);">
                        <div class="font-bold text-amber-300 mb-1.5 flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 inline-block"></span>
                            <span>Télémétrie Publicitaire Anti-Fraude</span>
                        </div>
                        <p class="text-slate-300 leading-relaxed">
                            Validation stricte des URL cibles, détection des auto-clics et attribution sécurisée des impressions pour un trafic authentique.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final Call-to-Action -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <div class="gold-card p-10 sm:p-14 relative overflow-hidden">
            <h2 class="font-luxury-title text-3xl sm:text-4xl font-bold text-slate-900 mb-4">
                Prêt à Déployer Vos Campagnes & Rejoindre la File ?
            </h2>
            <p class="text-slate-600 max-w-xl mx-auto text-sm leading-relaxed mb-8">
                Prenez place dans l'écosystème publicitaire d'élite Aureus. Accédez instantanément à l'environnement démo préconfiguré.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl gold-gradient-bg text-white font-semibold text-sm shadow-md hover:brightness-105 active:scale-95 transition">
                    Accéder à l'Environnement Démo
                </a>
                <a href="{{ route('directory.index') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-white border border-amber-300/80 text-amber-900 font-semibold text-sm shadow-xs hover:bg-amber-50/60 active:scale-95 transition">
                    Découvrir l'Annuaire
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
