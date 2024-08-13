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
            'since'=>fake()->datetime(),
            'to'=>fake()->datetime(),
            'state'=>fake()->randomElement(['occupied','available'])
        ];
    }
}
