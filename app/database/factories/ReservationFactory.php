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
            'available_day_id' => AvailableDay::factory(),
            'guest_id' => Guest::factory(),
            'state'=> ReservationStateEnum::PreReserved->name,
        ];
    }
}
