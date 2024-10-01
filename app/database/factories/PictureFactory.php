<?php

namespace Database\Factories;

use App\Models\Picture;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Picture>
 */
class PictureFactory extends Factory
{
    private static int $pictureIndex = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pictures = $this->pictures();
        $picture = $pictures[self::$pictureIndex];

        // Incrementar el índice y reiniciarlo si es necesario
        self::$pictureIndex = (self::$pictureIndex + 1) % count($pictures);

        return [
            'name' => $picture,
            'type' => 'jpeg',
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Picture $picture) {
            Storage::disk('publication-pictures')->copy("factory/$picture->name", "{$picture->publication->id}/{$picture->name}");
        });
    }

    public function pictures(): array
    {
        return [
            'picture00.jpeg',
            'picture01.jpeg',
            'picture02.jpeg',
        ];
    }
}