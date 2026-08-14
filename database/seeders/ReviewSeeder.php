<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Destination::all()->each(function ($destination) {

            $count = rand(10, 20);

            for ($i = 0; $i < $count; $i++) {

                Review::create([

                    'destination_id' => $destination->id,

                    'reviewer_name' => fake()->name(),

                    'rating' => fake()->randomFloat(1, 4.0, 5.0),

                    'comment' => fake()->paragraph(),

                ]);
            }
        });
    }
}
