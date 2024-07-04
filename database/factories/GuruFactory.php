<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => null,
            'NIP' => $this->faker->unique()->numberBetween(100000, 999999),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
