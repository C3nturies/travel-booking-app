<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function create(?string $slug = null)
    {
        $destination = null;

        if ($slug) {
            $destination = Destination::query()
                ->select([
                    'id',
                    'title',
                    'slug',
                    'country',
                    'type',
                    'price',
                    'rating',
                    'days',
                    'hero_image',
                    'optimized_hero_image',
                    'short_description',
                ])
                ->where('slug', $slug)
                ->firstOrFail();
        }

        $destinations = Destination::query()
            ->select([
                'id',
                'title',
                'slug',
                'price',
                'days',
                'rating',
                'country',
            ])
            ->orderBy('title')
            ->get();

        return view('booking', [
            'destination' => $destination,
            'destinations' => $destinations,
            'selectedSlug' => $slug,
        ]);
    }
    
    public function store(Request $request)
    {

        $validated = $request->validate([
            'destination_slug' => ['required', 'exists:destinations,slug'],
            'departure_date' => ['required', 'date', 'after_or_equal:today'],
            'adults' => ['required', 'integer', 'min:1'],
            'children' => ['nullable', 'integer', 'min:0'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:50'],
            'extras' => ['nullable', 'array'],
            'requests' => ['nullable', 'string', 'max:2000'],
            'total_price' => ['required', 'numeric', 'min:0'],
        ]);

        $destination = Destination::where('slug', $validated['destination_slug'])
            ->firstOrFail();

        $booking = Booking::create([
            'destination_id' => $destination->id,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'departure_date' => $validated['departure_date'],
            'adults' => $validated['adults'],
            'children' => $validated['children'] ?? 0,
            'extras' => $validated['extras'] ?? [],
            'requests' => $validated['requests'] ?? null,
            'total_price' => $validated['total_price'],
        ]);

        return response()->json([
            'message' => 'Booking request saved successfully.',
            'booking_id' => $booking->id,
        ], 201);
    }
}
