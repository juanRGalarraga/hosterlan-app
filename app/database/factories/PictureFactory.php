<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Picture>
 */
class PictureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement($this->pictures()),
            'type' => 'jpeg',
        ];
    }

    public function pictures(): array{
        return [
            'factory/picture00.jpeg',
            'factory/picture01.jpeg',
            'factory/picture02.jpeg',
        ];
    }
}
