<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Menu::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->name(),
            'price' => $this->faker->randomDigitNotZero(),
            'restaurant_id' => $this->faker->randomDigitNotZero()
        ];
    }
}
