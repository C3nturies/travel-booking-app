<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'departure_date',
        'adults',
        'children',
        'extras',
        'requests',
        'total_price'
    ];

    protected $casts = [
        'extras' => 'array'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
