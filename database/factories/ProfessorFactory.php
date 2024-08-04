<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professor>
 */
class ProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'firstname' => $this->faker->firstname,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->email,
            'sex' => 'M',
        ];
    }
}
