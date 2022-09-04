<?php

namespace Database\Factories;

use App\Models\Manga;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_manga' => Manga::all()->random()->id,
            'tom' => $this->faker->randomNumber(),
            'number' => $this->faker->randomNumber(),
            'title' => $this->faker->title,
            'premium_access' => $this->faker->boolean,
        ];
    }
}
