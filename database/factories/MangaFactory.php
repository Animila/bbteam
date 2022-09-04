<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class MangaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title_eng' => $this->faker->text,
            'title_ru' => $this->faker->text,
            'title_korean' => $this->faker->text,
            'text' => $this->faker->text,
            'censor' => $this->faker->boolean,
            'id_type' => Type::all()->random()->id,
            'id_status' => Status::all()->random()->id,
        ];
    }
}
