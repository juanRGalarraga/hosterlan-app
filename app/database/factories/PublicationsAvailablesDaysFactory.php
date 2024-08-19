<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PublicationsAvailablesDays;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publications_availables_days>
 */
class PublicationsAvailablesDaysFactory extends Factory
{
    
 
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'since'=>fake()->randomElement(['2024-08-01','2024-08-02','2024-08-03']),
            'to'=>fake()->randomElement(['2024-08-04','2024-08-05','2024-08-06']),
            'state'=>fake()->randomElement(['No disponible','Disponible','Ocupado'])
        ];
    }
}
