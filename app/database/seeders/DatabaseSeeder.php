<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\RentType;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\Publication;
use App\Models\Picture;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Owner::factory()->count(30)->create();

        Publication::factory()->has(Picture::factory()->count(4))->count(25)->create();
        
        User::factory()->count(1)->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);
    }
}
