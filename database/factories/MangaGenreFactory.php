<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Manga;
use Illuminate\Database\Eloquent\Factories\Factory;

class MangaGenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_manga'=>Manga::all()->random()->id,
            'id_genres'=>Genre::all()->random()->id,
        ];
    }
}
