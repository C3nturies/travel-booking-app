<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $destinations = [

            ['Bali Paradise Escape', 'Indonesia', 'Beach'],
            ['Santorini Luxury Stay', 'Greece', 'Luxury'],
            ['Tokyo Urban Discovery', 'Japan', 'City'],
            ['Iceland Northern Lights', 'Iceland', 'Nature'],
            ['Swiss Alps Adventure', 'Switzerland', 'Adventure'],
            ['Dubai Premium Experience', 'UAE', 'Luxury'],
            ['Maldives Ocean Retreat', 'Maldives', 'Beach'],
            ['Paris Romantic Weekend', 'France', 'City'],
            ['Morocco Desert Journey', 'Morocco', 'Adventure'],
            ['Thailand Island Hopping', 'Thailand', 'Beach'],
            ['Norway Fjord Explorer', 'Norway', 'Nature'],
            ['New York City Lights', 'USA', 'City'],
            ['Canadian Rockies', 'Canada', 'Nature'],
            ['Australian Coastal Escape', 'Australia', 'Beach'],
            ['Patagonia Expedition', 'Argentina', 'Adventure'],
            ['Prague Discovery', 'Czech Republic', 'City'],
            ['Croatian Island Cruise', 'Croatia', 'Beach'],
            ['Vienna Culture Tour', 'Austria', 'City'],
            ['Cape Town Explorer', 'South Africa', 'Adventure'],
            ['Machu Picchu Trek', 'Peru', 'Adventure'],
        ];

        $selected = fake()->randomElement($destinations);

        $title = $selected[0] . ' ' . fake()->numberBetween(1, 999);

        return [

            'title' => $title,

            'slug' => Str::slug($title),

            'country' => $selected[1],

            'type' => $selected[2],

            'price' => fake()->numberBetween(1200, 5000),

            'days' => fake()->numberBetween(4, 14),

            'rating' => fake()->randomFloat(1, 4.2, 5.0),

            'hero_image' => fake()->randomElement([
                'https://images.unsplash.com/photo-1537996194471-e657df975ab4',
                'https://images.unsplash.com/photo-1507525428034-b723cf961d3e',
                'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf',
                'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff',
                'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee',
            ]),

            'short_description' => fake()->sentence(),

            'description' => fake()->paragraphs(5, true),

            'featured' => fake()->boolean(20),
            'discount_percent' => fake()->optional(0.45)->numberBetween(5, 35),
            'available_from' => fake()->dateTimeBetween('+1 week', '+2 months')->format('Y-m-d'),
            'available_until' => fake()->dateTimeBetween('+3 months', '+8 months')->format('Y-m-d'),
        ];
    }
}
