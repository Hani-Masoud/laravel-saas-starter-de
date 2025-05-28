<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'iso_code' => strtoupper($this->faker->unique()->lexify('??')),
            'name_en' => $this->faker->country,
            'name_de' => $this->faker->country,
        ];
    }
}

