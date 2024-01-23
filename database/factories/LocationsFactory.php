<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Locations>
 */
class LocationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'locations_id' => fake()->name(),
            'type' => fake()->name(),
            'pieces' => fake()->name(),
            'cuisine' =>fake()->name(),
            'douches' =>fake()->name(),
            'wc' =>fake()->name(),
            'court_description' =>fake()->name(),
            'pays' =>fake()->name(),
            'ville' =>fake()->name(),
            'zone' =>fake()->name(),
            'loyer' =>fake()->name(),
            'avances' =>fake()->name(),
            'prepayes' =>fake()->name(),
            'cautions' =>fake()->name(),
            'commission' =>fake()->name(),
            'longue_description' =>fake()->name(),
            'auteur_name' =>fake()->name(),
            'auteur_type' =>fake()->name(),
            'auteur_id' =>fake()->name(),
            'statut' =>fake()->name()
        ];
    }
}
