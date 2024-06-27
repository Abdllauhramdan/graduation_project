<?php

namespace Database\Factories;

use App\Models\Sales_Operation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesOperationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sales_Operation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'quantity_sold' => $this->faker->numberBetween(1, 100),
            'total_price' => $this->faker->randomFloat(2, 10, 500),
            // Add other fields as needed
        ];
    }
}
