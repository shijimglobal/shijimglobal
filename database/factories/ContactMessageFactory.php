<?php

namespace Database\Factories;

use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactMessage>
 */
class ContactMessageFactory extends Factory
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
            'phone' => fake()->numerify('9#######'),
            'email' => fake()->optional()->safeEmail(),
            'service' => fake()->randomElement(StoreContactRequest::SERVICES),
            'message' => fake()->paragraph(),
            'read_at' => null,
        ];
    }

    /**
     * Indicate that the message has already been read.
     */
    public function read(): static
    {
        return $this->state(fn (array $attributes): array => [
            'read_at' => now(),
        ]);
    }
}
