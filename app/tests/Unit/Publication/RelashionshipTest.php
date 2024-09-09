<?php

namespace Tests\Unit\Publication;

use App\Models\RentType;
use App\Models\Publication;
use App\Models\PublicationDayAvailable;
use App\Models\Guest;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RelashionshipTest extends TestCase
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

        $publicationDayAvailable = PublicationDayAvailable::factory()->create([
            'publication_id' => $publication->id,
            'guest_id' => $guest->id,
        ]);
        
        $this->assertInstanceOf(Publication::class, $publicationDayAvailable->publication);
        $this->assertInstanceOf(Guest::class, $publicationDayAvailable->guest);
    }
}
