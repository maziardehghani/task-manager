<?php

namespace Database\Factories;

use App\Enums\Statuses;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(2),
            'description' => $this->faker->sentence(2),
            'status' => $this->faker->randomElement(Statuses::taskStatuses()),
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'end_date' => null,
        ];
    }

    public function todo()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => Statuses::TODO,
            ];
        });
    }

    public function doing()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => Statuses::DOING,
            ];
        });
    }

    public function done()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => Statuses::DONE,
                'end_date' => $this->faker->dateTimeBetween(
                    $attributes['start_date'],
                    '+1 month'
                ),
            ];
        });
    }


    public function configure()
    {
        return $this->afterCreating(function (Task $task) {
            if ($task->status === 'done' && is_null($task->end_date)) {
                $task->update([
                    'end_date' => now()
                ]);
            }
        });
    }

}
