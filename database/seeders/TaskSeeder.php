<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            $user->tasks()->saveMany(
                Task::factory()
                    ->count(15)
                    ->sequence(
                        ['status' => 'todo'],
                        ['status' => 'doing'],
                        ['status' => 'done'],
                    )
                    ->for($user)
                    ->create()
            );
        });
    }
}
