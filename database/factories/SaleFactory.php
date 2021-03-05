<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'name' => $this->faker->name,
            'identification' => $this->faker->uuid,
            'email' => $this->faker->unique()->safeEmail,
            'quantity' => rand(1, 8),
            'service_id' => rand(1, 5)
        ];
    }
}
