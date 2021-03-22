<?php

namespace Database\Factories;

use App\Models\DishesTypeFood;
use Illuminate\Database\Eloquent\Factories\Factory;

class DishesTypeFoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DishesTypeFood::class;

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
