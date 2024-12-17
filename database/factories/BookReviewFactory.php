<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookReview>
 */
class BookReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'review' => $this->faker->sentence(rand(5, 15)), // Review berisi kata-kata random
            'rating' => $this->faker->numberBetween(3, 5), // Rating antara 1-5
            'user_id' => $this->faker->numberBetween(1, 20), // User ID antara 1-20
            'book_id' => $this->faker->numberBetween(1, 8), // Book ID antara 1-8
            'created_at' => now(), // Waktu saat ini
            'updated_at' => now(),
        ];
    }
}
