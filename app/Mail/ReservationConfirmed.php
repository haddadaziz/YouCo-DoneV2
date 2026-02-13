<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class ReservationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $pdfPath;

    public function __construct(Reservation $reservation, $pdfPath)
    {
        $this->reservation = $reservation;
        $this->pdfPath = $pdfPath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre réservation - ' . $this->reservation->restaurant->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reservations.confirmed',
        );
    }

    public function attachments(): array
    {
        $attachments = [];
        if ($this->pdfPath && file_exists($this->pdfPath)) {
            $attachments[] = Attachment::fromPath($this->pdfPath)
                ->as('facture_reservation.pdf')
                ->withMime('application/pdf');
        }
        return $attachments;
    }
}
