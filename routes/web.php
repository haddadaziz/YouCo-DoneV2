<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\ReservationController;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

// 1. Page d'accueil = Liste des restaurants (Visible par tous)
Route::get('/', [RestaurantController::class, 'index'])->name('home');

// 2. La route /dashboard sert maintenant de "Gare de triage"
// Elle ne montre plus jamais la vue par défaut, elle redirige tout de suite.
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/dashboard', function () {
        // Si c'est un restaurateur -> On l'envoie sur son espace PRO
        if (Auth::user()->role === 'restaurateur') {
            return redirect()->route('dashboard.restaurateur');
        }
        
        // Si c'est un client -> On le renvoie à l'ACCUEIL (Liste des restos)
        // Il ne verra jamais le dashboard vide
        return redirect()->route('home');
        
    })->name('dashboard');
});

// 3. Espace PRO (Réservé aux restaurateurs)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/restaurateur', function () {
        
        // Sécurité
        if (!auth()->user() || auth()->user()->role !== 'restaurateur') {
            abort(403);
        }
        
        $restaurants = Restaurant::where('user_id', auth()->id())->get();
        return view('restaurants.dashboard', compact('restaurants'));
        
    })->name('dashboard.restaurateur');
});

Route::resource('restaurants', RestaurantController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('restaurants/{restaurant}/availabilities', [AvailabilityController::class, 'index'])->name('restaurants.availabilities.index');
    Route::post('restaurants/{restaurant}/availabilities', [AvailabilityController::class, 'store'])->name('restaurants.availabilities.store');
    Route::delete('availabilities/{availability}', [AvailabilityController::class, 'destroy'])->name('availabilities.destroy');

    Route::post('restaurants/{restaurant}/reserve', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('reservations/{reservation}/pay', [ReservationController::class, 'pay'])->name('reservations.pay');
    Route::get('reservations/success', [ReservationController::class, 'success'])->name('reservations.success');

    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
});