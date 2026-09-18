<?php

declare(strict_types=1);

use App\Http\Controllers\AdDirectoryController;
use App\Http\Controllers\AdPackController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BrowserShowcaseController;
use App\Http\Controllers\CyclerQueueController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aureus Ad Cycler HTTP Route Registry.
| Zero business logic in routes. All actions strictly handled by controllers.
|
*/

// Public Landing Page & Showcase
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/browser', [BrowserShowcaseController::class, 'index'])->name('browser.showcase');

// Public Directory & Click Telemetry Routes
Route::get('/directory', [AdDirectoryController::class, 'index'])->name('directory.index');
Route::get('/directory/click/{ad}', [AdDirectoryController::class, 'click'])->name('directory.click');

// Guest Authentication Routes
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});

// Authenticated Application Member Routes
Route::middleware(['auth'])->group(function (): void {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Wallet & Balance Management
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::post('/wallet/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');

    // Ad Pack Tiers Storefront & Cycler Enrollment
    Route::get('/ad-packs', [AdPackController::class, 'index'])->name('ad-packs.index');
    Route::post('/ad-packs/buy', [AdPackController::class, 'buy'])->name('ad-packs.buy');

    // FIFO Cycler Queue Status Visualizer
    Route::get('/cycler', [CyclerQueueController::class, 'index'])->name('cycler.index');

    // Member Advertising Campaign Management
    Route::get('/ads', [AdvertisementController::class, 'index'])->name('ads.index');
    Route::get('/ads/create', [AdvertisementController::class, 'create'])->name('ads.create');
    Route::post('/ads', [AdvertisementController::class, 'store'])->name('ads.store');
    Route::post('/ads/{ad}/allocate', [AdvertisementController::class, 'allocateCredits'])->name('ads.allocate');
});
