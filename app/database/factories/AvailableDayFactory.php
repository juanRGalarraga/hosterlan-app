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
        $since = fake()->dateTimeThisYear();
        $to = (clone $since)->modify('+7 days');
        $sinceFormatted = $since->format('Y-m-d');
        $toFormatted = $to->format('Y-m-d');
        return [
            'publication_id' => Publication::factory(),
            'since'=> $sinceFormatted,
            'to'=> $toFormatted,
            'state'=> AvailableDayEnum::Available->name
        ];
    }
}
