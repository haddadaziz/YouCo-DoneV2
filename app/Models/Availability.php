<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $fillable = [
        'restaurant_id',
        'date',
        'start_time',
        'end_time',
        'capacity',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
