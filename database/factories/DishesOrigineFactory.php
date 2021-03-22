<?php

namespace Database\Factories;

use App\Models\DishesOrigine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DishesOrigineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DishesOrigine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'libelle' => $this->faker->name
        ];
    }
}
