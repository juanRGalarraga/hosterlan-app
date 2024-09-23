<?php

namespace Tests\Unit\Publication;

use App\Models\RentType;
use App\Models\Publication;
use App\Models\AvailableDay;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicationRelashionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */

    public function test_guest_have_has_many_publication_day_available(): void
    {
        $rentType = RentType::factory()->create();

        $user = User::factory()->create();

        $guest = Guest::factory()->create([
            'user_id' => $user->id
        ]);
        
        $publication = Publication::factory()->create([
            'rent_type_id' => $rentType->id,
            'user_id' => $user->id,
        ]);

        $dayAvailable = AvailableDay::factory()->create([
            'publication_id' => $publication->id,
        ]);

        $reservationGuest = Reservation::factory()->create([
            'available_day_id' => $dayAvailable->id,
            'guest_id' => $guest->id,
        ]);
        
        $this->assertInstanceOf(AvailableDay::class, $reservationGuest->availableDay);
        $this->assertInstanceOf(Publication::class, $reservationGuest->availableDay->publication);
        $this->assertInstanceOf(User::class, $reservationGuest->guest->user);
        $this->assertInstanceOf(Guest::class, $reservationGuest->guest);
        $this->assertInstanceOf(Reservation::class, $dayAvailable->reservations->first());
    }
}
