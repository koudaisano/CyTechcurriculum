<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
'company_id' => $this->faker->randomNumber(4),
'product_name' => $this->faker->word,
'price' => $this->faker->randomFloat(0, 100 , 250),
'stock' => $this->faker->numberBetween(1, 30),
'comment' => $this->faker->sentence,
        ];
    }
}
