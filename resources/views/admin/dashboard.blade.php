@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tableau de bord Administrateur') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                <p class="text-sm text-gray-500 uppercase font-bold">Total Restaurants</p>
                <p class="text-3xl font-black">{{ $totalRestaurants }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                <p class="text-sm text-gray-500 uppercase font-bold">Réservations Confirmées</p>
                <p class="text-3xl font-black">{{ $totalReservations }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-500">
                <p class="text-sm text-gray-500 uppercase font-bold">Revenu Total (Acomptes)</p>
                <p class="text-3xl font-black">{{ number_format($totalRevenue, 2) }} €</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Top 5 Restaurants</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                            <th class="text-left text-xs font-medium text-gray-500 uppercase">Réservations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($topRestaurants as $restaurant)
                        <tr>
                            <td class="py-2">{{ $restaurant->name }}</td>
                            <td class="py-2">{{ $restaurant->reservations_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Répartition par Ville (Query Builder)</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="text-left text-xs font-medium text-gray-500 uppercase">Ville</th>
                            <th class="text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($restaurantsByCity as $cityStat)
                        <tr>
                            <td class="py-2">{{ $cityStat->city }}</td>
                            <td class="py-2">{{ $cityStat->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
