<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $heroDestinations = Cache::remember(
            'home.hero_destinations',
            now()->addMinutes(30),
            function () {
                return Destination::query()
                    ->select($this->destinationCardColumns())
                    ->where('featured', true)
                    ->orderByDesc('rating')
                    ->take(5)
                    ->get()
                    ->values()
                    ->toArray();
            }
        );

        $heroDestinations = $this->toObjectCollection($heroDestinations);

        $firstHeroDestination = $heroDestinations->first();

        $featuredDestinations = Cache::remember(
            'home.featured_destinations',
            now()->addMinutes(30),
            function () {
                return Destination::query()
                    ->select($this->destinationCardColumns())
                    ->where('featured', true)
                    ->orderByDesc('rating')
                    ->take(6)
                    ->get()
                    ->values()
                    ->toArray();
            }
        );

        $featuredDestinations = $this->toObjectCollection($featuredDestinations);

        return view('home', [
            'heroDestinations' => $heroDestinations,
            'firstHeroDestination' => $firstHeroDestination,
            'featuredDestinations' => $featuredDestinations,
        ]);
    }

    public function popularDestinations()
    {
        $page = request()->query('page', 1);

        $destinations = Cache::remember(
            "ajax.popular_destinations.page.{$page}",
            now()->addMinutes(30),
            function () {
                return Destination::query()
                    ->select($this->destinationCardColumns())
                    ->orderByDesc('rating')
                    ->paginate(3)
                    ->toArray();
            }
        );

        return response()->json($destinations);
    }

    public function experienceDestinations()
    {
        $page = request()->query('experience_page', 1);

        $destinations = Cache::remember(
            "ajax.experience_destinations.page.{$page}",
            now()->addMinutes(30),
            function () {
                return Destination::query()
                    ->select($this->destinationCardColumns())
                    ->whereIn('type', ['Adventure', 'Luxury', 'Nature', 'Beach'])
                    ->orderByDesc('rating')
                    ->paginate(3, ['*'], 'experience_page')
                    ->toArray();
            }
        );

        return response()->json($destinations);
    }
    
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

    private function toObjectCollection(array $items)
    {
        return collect($items)->map(function ($item) {
            return (object) $item;
        });
    }
}
