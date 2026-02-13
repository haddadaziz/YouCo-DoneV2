<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Availability;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Jobs\GenerateReservationQrCode;
use App\Mail\ReservationConfirmed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use FPDF;

class ReservationController extends Controller
{
    public function store(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'number_of_guests' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        // Formatter l'heure pour la comparaison (Stocker HH:MM:SS dans la DB généralement)
        $time = $validated['time'];

        // Vérifier la disponibilité
        $availability = $restaurant->availabilities()
            ->where('date', $validated['date'])
            ->where('start_time', '<=', $time)
            ->where('end_time', '>=', $time)
            ->first();

        if (!$availability) {
            return back()->with('error', 'Aucune disponibilité trouvée pour ce créneau.');
        }

        // Vérifier la capacité restante
        $alreadyReserved = $restaurant->reservations()
            ->where('date', $validated['date'])
            ->where('time', $validated['time'])
            ->where('status', '!=', 'cancelled')
            ->sum('number_of_guests');

        if (($alreadyReserved + $validated['number_of_guests']) > $availability->capacity) {
            return back()->with('error', 'Désolé, plus assez de place pour ce créneau.');
        }

        $reservation = $restaurant->reservations()->create([
            'user_id' => auth()->id(),
            'date' => $validated['date'],
            'time' => $validated['time'],
            'number_of_guests' => $validated['number_of_guests'],
            'notes' => $validated['notes'],
            'status' => 'pending',
            'amount' => 10.00, // Acompte fixe pour l'exemple
        ]);

        return redirect()->route('reservations.pay', $reservation);
    }

    public function pay(Reservation $reservation)
    {
        if (auth()->id() !== $reservation->user_id) {
            abort(403);
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Réservation - ' . $reservation->restaurant->name,
                    ],
                    'unit_amount' => $reservation->amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('reservations.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}&reservation_id=' . $reservation->id,
            'cancel_url' => route('reservations.success', [], true) . '?error=payment_cancelled&reservation_id=' . $reservation->id,
        ]);

        $reservation->update(['stripe_id' => $checkout_session->id]);

        return redirect($checkout_session->url);
    }

    public function success(Request $request)
    {
        $reservation = Reservation::with(['user', 'restaurant'])->findOrFail($request->reservation_id);
        if ($request->error === 'payment_cancelled') {
            return redirect()->route('home')->with('error', 'Le paiement a été annulé. Votre réservation n\'a pas été validée.');
        }

        // En production, on vérifierait via Webhook Stripe
        $reservation->update([
            'payment_status' => 'paid',
            'status' => 'confirmed'
        ]);

        // Générer le QR Code via Job
        GenerateReservationQrCode::dispatch($reservation);

        // Générer le PDF
        $pdfPath = $this->generatePdf($reservation);

        // Envoyer l'email
        Mail::to($reservation->user->email)->send(new ReservationConfirmed($reservation, $pdfPath));

        return redirect()->route('home')->with('success', 'Votre réservation est confirmée ! Un email de confirmation vous a été envoyé.');
    }

    private function generatePdf(Reservation $reservation)
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, utf8_decode('Facture de Réservation'));
        $pdf->Ln(20);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40, 10, utf8_decode('Restaurant : ' . $reservation->restaurant->name));
        $pdf->Ln(10);
        $pdf->Cell(40, 10, utf8_decode('Client : ' . $reservation->user->name));
        $pdf->Ln(10);
        $pdf->Cell(40, 10, utf8_decode('Date : ' . $reservation->date));
        $pdf->Ln(10);
        $pdf->Cell(40, 10, utf8_decode('Heure : ' . $reservation->time));
        $pdf->Ln(10);
        $pdf->Cell(40, 10, utf8_decode('Nombre de personnes : ' . $reservation->number_of_guests));
        $pdf->Ln(10);
        $pdf->Cell(40, 10, utf8_decode('Montant payé : ' . $reservation->amount . ' EUR'));

        $filename = 'facture_' . $reservation->id . '.pdf';
        $path = storage_path('app/public/factures/' . $filename);

        if (!file_exists(storage_path('app/public/factures'))) {
            mkdir(storage_path('app/public/factures'), 0755, true);
        }

        $pdf->Output('F', $path);

        return $path;
    }
}
