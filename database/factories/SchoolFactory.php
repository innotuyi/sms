<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'school_code' => $this->faker->unique()->regexify('SCH[0-9]{3}'), // Generates unique school codes like SCH001
            'school_name' => $this->faker->company, // Generates random school names
        ];
    }
}
