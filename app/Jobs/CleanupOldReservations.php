<?php

namespace App\Jobs;

use App\Models\Reservation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Carbon\Carbon;

class CleanupOldReservations implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        Reservation::where('date', '<', Carbon::now()->subDays(30))
            ->delete();
    }
}
