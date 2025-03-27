<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use App\Traits\TestTools;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{

    use RefreshDatabase, TestTools;

    public function setUp(): void
    {
        Parent::setUp();

        $this->seed();
    }
    /**
     * A basic feature test example.
     */
    public function test_user_can_get_tasks(): void
    {
        $response = $this->getData('/api/tasks');

        $response->assertStatus(200);
    }


    public function test_user_can_his_task()
    {
        $testUser = User::query()->whereEmail('maziar@gmail.com')->first();

        $task = Task::query()->whereUser($testUser)->inRandomOrder()->first()->id;

        $response = $this->getData(route('tasks.show', $task));

        $response->assertStatus(200);
    }

}
