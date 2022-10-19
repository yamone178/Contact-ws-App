<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstName' => fake()->firstName(),
            'lastName' => $this->faker->lastName(),
            'email'=> fake()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'birthday'=>$this->faker->date('d/m/y'),
            'jobTitle' => $this->faker->jobTitle(),
            'note' => $this->faker->realText()
        ];
    }
}
