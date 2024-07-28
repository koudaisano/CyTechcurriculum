<?php

namespace Database\Factories;

use App\Models\companie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Companie>
 */
class companieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company_name' =>$this->faker->company,
            'street_address' =>$this->faker->address,
            'representative_name' =>$this->faker->name,

        ];
    }
}
