<?php

namespace Database\Factories;

use App\Models\StuffLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stuff>
 */
class StuffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = fake('id_ID');

        return [
            'stuff_location_id' => StuffLocation::inRandomOrder()->first()->id,
            'name'              => $faker->realText(10),
            'stock'             => rand(100, 1000),
            'unit'              => rand(1, 3)
        ];
    }
}
