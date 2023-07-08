<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'position' => fake()->randomElement(['Manager', 'Founder CEO', 'Instructor', "Owner", 'Writer']),
            'image' => 'upload/testimonail/thumbnail/1770842445149491.jpg',
            'message' => fake()->text($maxNbChars = 50),

        ];
    }
}
