<?php

namespace Database\Factories;

use App\Enums\Publication\AvailableDayEnum;
use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AvailableDay>
 */
class AvailableDayFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $since = (new \DateTime())->format('Y-m-d');
        $days = fake()->numberBetween( 2, 20);
        $to = (new \DateTime($since))->modify("+$days days")->format('Y-m-d');
        return [
            'publication_id' => Publication::factory(),
            'since'=> $since,
            'to'=> $to,
            'state'=> AvailableDayEnum::Available->name
        ];
    }
}
