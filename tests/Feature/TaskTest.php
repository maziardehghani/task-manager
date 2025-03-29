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

}
