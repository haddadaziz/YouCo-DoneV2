<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Restaurant::query();

        if ($search = $request->input('search')) {
            $search = mb_strtolower($search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%$search%"])
                  ->orWhereRaw('LOWER(city) LIKE ?', ["%$search%"])
                  ->orWhereRaw('LOWER(cuisine_type) LIKE ?', ["%$search%"]);
            });
        }

        $restaurants = $query->latest()->get();
        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ta sécurité manuelle (on la garde)
        if (!auth()->check() || auth()->user()->role !== 'restaurateur') {
            abort(403, 'Seuls les restaurateurs peuvent ajouter un restaurant.');
        }
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Sécurité (Même logique que ton create)
        if (!auth()->check() || auth()->user()->role !== 'restaurateur') {
            abort(403, 'Seuls les restaurateurs peuvent ajouter un restaurant.');
        }

        // 2. Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'cuisine_type' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|max:10000', // 10MB Max
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurants', 'public');
        }

        // 4. Création en base de données
        // On utilise la relation pour lier automatiquement l'ID du user connecté
        $request->user()->restaurants()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'cuisine_type' => $validated['cuisine_type'],
            'capacity' => $validated['capacity'],
            'image' => $imagePath,
        ]);

        // 5. Redirection vers le dashboard
        return redirect()->route('dashboard.restaurateur')->with('success', 'Restaurant ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return view('restaurants.show', compact('restaurant'));
    }
}