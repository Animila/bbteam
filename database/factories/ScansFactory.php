<?php

namespace Database\Factories;

use App\Models\Chapter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScansFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_chapter'=>Chapter::all()->random()->id,
            'url'=>$this->faker->imageUrl,
            'number'=>$this->faker->randomNumber()
        ];
    }
}
