<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    private int $perPage = 9;

    private function destinationCardColumns(): array
    {
        return [
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
            'discount_percent',
            'available_from',
            'available_until',
        ];
    }

    private function listingQuery(Request $request)
    {
        $query = Destination::query()
            ->select($this->destinationCardColumns());

        if ($request->filled('search')) {
            $search = $request->query('search');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type') && $request->query('type') !== 'all') {
            $query->where('type', $request->query('type'));
        }

        match ($request->query('sort', 'popular')) {
            'price-low' => $query->orderBy('price'),
            'price-high' => $query->orderByDesc('price'),
            'duration' => $query->orderBy('days'),
            'rating' => $query->orderByDesc('rating'),
            default => $query->orderByDesc('rating'),
        };

        return $query;
    }

    public function index(Request $request)
    {
        $destinations = $this->listingQuery($request)
            ->paginate($this->perPage)
            ->withQueryString();

        $types = Destination::query()
            ->select('type')
            ->whereNotNull('type')
            ->distinct()
            ->orderBy('type')
            ->pluck('type')
            ->values();

        return view('destinations', [
            'destinations' => $destinations,
            'types' => $types,
            'filters' => [
                'search' => $request->query('search', ''),
                'type' => $request->query('type', 'all'),
                'sort' => $request->query('sort', 'popular'),
            ],
        ]);
    }

    public function ajax(Request $request)
    {
        $destinations = $this->listingQuery($request)
            ->paginate($this->perPage)
            ->withQueryString();

        return response()->json($destinations);
    }

    public function show(string $slug)
    {
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
                'description',
            ])
            ->with([
                'images' => function ($query) {
                    $query
                    ->select([
                        'id',
                        'destination_id',
                        'image_url',
                        'alt_text',
                        'caption',
                        'width',
                        'height',
                        'sort_order',
                    ])
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->limit(6);
                },
                'reviews' => function ($query) {
                    $query
                        ->select([
                            'id',
                            'destination_id',
                            'reviewer_name',
                            'rating',
                            'comment',
                            'created_at',
                        ])
                        ->latest()
                        ->take(3);
                },
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('destination-details', [
            'destination' => $destination,
        ]);
    }
}