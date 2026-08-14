<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    /** @use HasFactory<\Database\Factories\DestinationFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'country',
        'type',
        'price',
        'days',
        'rating',
        'hero_image',
        'short_description',
        'description',
        'featured',
        'discount_percent',
        'available_from',
        'available_until',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(DestinationImage::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
