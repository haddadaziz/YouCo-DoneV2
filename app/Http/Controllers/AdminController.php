<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalRestaurants = Restaurant::count();
        $totalReservations = Reservation::where('status', 'confirmed')->count();
        $totalRevenue = Reservation::where('payment_status', 'paid')->sum('amount');
        
        // Statistiques globales
        $topRestaurants = Restaurant::withCount('reservations')
            ->orderBy('reservations_count', 'desc')
            ->take(5)
            ->get();

        // Répartition géographique (Query Builder uniquement comme demandé)
        $restaurantsByCity = DB::table('restaurants')
            ->select('city', DB::raw('count(*) as total'))
            ->groupBy('city')
            ->get();

        return view('admin.dashboard', compact(
            'totalRestaurants', 
            'totalReservations', 
            'totalRevenue', 
            'topRestaurants', 
            'restaurantsByCity'
        ));
    }
}
