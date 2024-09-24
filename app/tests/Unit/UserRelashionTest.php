<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Phone;
use App\Models\Guest;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class UserRelashionTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_guest_instance(): void
    {
        $user = User::factory()->create([
            'email' => 'saraza1@gmail.com',
            'name' => 'Saraza Firulete',
            'password' => Hash::make('password')
        ]);

        Guest::factory()->create([
            'user_id' => $user->id
        ]);

        $this->assertInstanceOf(Guest::class, $user->guest);
    }

    public function test_owner_instance(): void
    {
        $user = User::factory()->create([
            'email' => 'saraza2@gmail.com',
            'name' => 'Saraza Firulete',
            'password' => Hash::make('password')
        ]);

        Owner::factory()->create([
            'user_id' => $user->id
        ]);

        $this->assertInstanceOf(Owner::class, $user->owner);
    }

    public function test_phone_instance(): void
    {
        $user = User::factory()->create([
            'email' => 'saraza@gmail.com',
            'name' => 'Saraza Firulete',
            'password' => Hash::make('password')
        ]);

        PHone::factory()->create([
            'user_id' => $user->id,
            'area_code' => fake()->countryCode(),
            'number' => fake()->phoneNumber(),
        ]);

        $this->assertInstanceOf(Phone::class, $user->phones->first());
    }
}
