<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'zip_code',
        'cuisine_type',
        'capacity',
        'image',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }
}