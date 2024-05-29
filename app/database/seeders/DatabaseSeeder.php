<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\RentType;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\Publication;
use App\Models\Picture;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Owner::factory()->count(30)->create();
        Publication::factory()->has(Picture::factory()->count(3))->count(50)->create();

        
        User::factory()->count(1)->create([
            'email' => 'juan_dlp2@outlook.com',
            'password' => '$2y$12$tVvrEzxs6KEi7Uc6cEJs7uoG4OZ5w0eGCqWEwX7geR5xY4/FL2v5u'
        ]);
    }
}
