<?php

namespace Database\Factories;

use App\Enums\Reservation\ReservationStateEnum;
use App\Models\Guest;
use App\Models\AvailableDay;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'available_day_id' => AvailableDay::inRandomOrder()->first()->id,
            'guest_id' => Guest::inRandomOrder()->first()->id,
            'state'=> ReservationStateEnum::PreReserved->name,
        ];
    }
}
