<?php

namespace Database\Factories;

use App\Models\Manga;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class MangaTagFactory extends Factory
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
            'id_tags'=>Tag::all()->random()->id,
        ];
    }
}
