<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use App\Traits\TestTools;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
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

        $task = Task::query()->whereUser($testUser)->inRandomOrder()->first()?->id;

        $response = $this->getData(route('tasks.show', $task));

        $response->assertStatus(200);
    }

    public function test_users_cant_see_other_users_tasks(): void
    {
        $user1 = User::factory()->create(['email' => 'user1@example.com']);
        $user2 = User::factory()->create(['email' => 'user2@example.com']);

        $user1Task = Task::factory()->create(['user_id' => $user1->id]);

        $token = $user2->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Authorization" => 'Bearer ' . $token
        ])->getJson(route('tasks.show', $user1Task->id));

        $response->assertStatus(403);

    }


    public function test_user_can_create_a_task(): void
    {
        $response = $this->postData(route('tasks.store'), [
           'title' => 'Task test',
           'description' => 'Task test',
           'status' => 'todo',
           'start_date' => '2025/5/26',
            'end_date' => null,
        ]);

        $response->assertStatus(200);
    }


    public function test_user_can_update_a_task(): void
    {
        $user = User::factory()->create(['email' => 'user1@example.com']);
        $task = Task::factory()->create(['user_id' => $user->id]);
        $token = $user->createToken('test-token')->plainTextToken;
        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Authorization" => 'Bearer ' . $token
        ])->postJson(route('tasks.update', $task->id),[
            'title' => 'Task test',
            'description' => 'Task test',
            'status' => 'todo',
            'start_date' => '2025/5/26',
            'end_date' => null,
            '_method' => 'PUT',
        ]);


        $response->assertStatus(200);
    }

}
