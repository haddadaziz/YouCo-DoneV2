@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
            <h1 class="text-3xl font-bold mb-4">Confirmation de réservation</h1>
            <p class="mb-6">Bonjour {{ $reservation->user->name }},</p>
            <p class="mb-4">Votre réservation au restaurant <strong>{{ $reservation->restaurant->name }}</strong> est confirmée pour le <strong>{{ $reservation->date }}</strong> à <strong>{{ $reservation->time }}</strong>.</p>
            <p class="mb-4">Nombre de personnes : {{ $reservation->number_of_guests }}</p>
            <p class="mb-4">Vous trouverez votre facture en pièce jointe.</p>
            <p class="mt-8 text-sm text-gray-500">Merci de votre confiance !</p>
        </div>
    </div>
</div>
@endsection
