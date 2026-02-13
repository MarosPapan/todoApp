<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $completed = $this->faker->boolean(30); // ~30% dokončené
        
        $dueAt = $completed
            ? $this->faker->dateTimeBetween('-10 days', 'now')
            : $this->faker->optional(0.8)->dateTimeBetween('now', '+20 days');

        return [
            
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
            'due_at' => $dueAt,
            'completed' => $completed,
            'user_id' => User::factory(),

        ];
    }
}
