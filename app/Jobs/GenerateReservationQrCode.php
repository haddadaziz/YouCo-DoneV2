<?php

namespace App\Jobs;

use App\Models\Reservation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class GenerateReservationQrCode implements ShouldQueue
{
    use Queueable;

    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function handle(): void
    {
        $data = "Reservation ID: {$this->reservation->id}\nRestaurant: {$this->reservation->restaurant->name}\nDate: {$this->reservation->date}\nTime: {$this->reservation->time}";
        
        $qrCode = QrCode::format('png')->size(200)->generate($data);
        
        $path = "qrcodes/reservation_{$this->reservation->id}.png";
        Storage::disk('public')->put($path, $qrCode);
        
        $this->reservation->update(['qr_code' => $path]);
    }
}
