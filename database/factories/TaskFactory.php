<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->text(),
            'due_date' => fake()->dateTimeBetween('now', '+2 months'),
            'status' => fake()->randomElement(['pending', 'complete', 'in_progress', 'due']),
        ];
    }
}
