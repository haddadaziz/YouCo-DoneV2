<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AvailabilityController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        if (auth()->id() !== $restaurant->user_id) {
            abort(403);
        }

        $availabilities = $restaurant->availabilities()->orderBy('date')->orderBy('start_time')->get();
        return view('availabilities.index', compact('restaurant', 'availabilities'));
    }

    public function store(Request $request, Restaurant $restaurant)
    {
        if (auth()->id() !== $restaurant->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);

        // Validation manuelle pour comparer les heures si elles sont sur la même date
        if ($validated['end_time'] <= $validated['start_time']) {
            return back()->withErrors(['end_time' => 'L\'heure de fin doit être après l\'heure de début.'])->withInput();
        }

        $restaurant->availabilities()->create([
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'capacity' => $validated['capacity'],
        ]);

        return back()->with('success', 'Disponibilité ajoutée.');
    }

    public function destroy(Availability $availability)
    {
        if (auth()->id() !== $availability->restaurant->user_id) {
            abort(403);
        }

        $availability->delete();
        return back()->with('success', 'Disponibilité supprimée.');
    }
}
