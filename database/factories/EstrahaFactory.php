<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Estraha;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstrahaFactory extends Factory
{
    protected $model = Estraha::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'category_id' => Category::factory(),
        ];
    }
}
