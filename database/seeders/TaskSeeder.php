<?php

namespace Database\Seeders;

use App\Enums\Statuses;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sequenceData = [];

        foreach (Statuses::taskStatuses() as $status) {
            $sequenceData[] = ['status' => $status];
        }

        User::all()->each(function ($user) use ($sequenceData) {
            $user->tasks()->saveMany(
                Task::factory()
                    ->count(15)
                    ->sequence(...$sequenceData)
                    ->for($user)
                    ->create()
            );
        });
    }
}
