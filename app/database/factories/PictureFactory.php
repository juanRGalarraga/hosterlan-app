<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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

        $images = [
            '0000001' => 'jpg',
            '0000002' => 'jpg',
            '0000003' => 'jpg',
            '0000004' => 'png',
        ];

        $randomKey = fake()->randomKey($images);

        return [
            'name' => $randomKey,
            'type' => $images[$randomKey],
        ];
    }
}
