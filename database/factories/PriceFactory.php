<?php

namespace Database\Factories;

use App\Models\Estraha;
use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    protected $model = Price::class;

    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'estraha_id' => Estraha::factory(),
            'discount' => $this->faker->numberBetween(0, 30) // Assuming a percentage discount
        ];
    }
}
