<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Restaurant::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->name(),
            'grade' => $this->faker->randomDigitNotZero(),
            'localization' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'website' => $this->faker->name(),
            'hours' => $this->faker->randomDigitNotZero(),
        ];
    }
}
