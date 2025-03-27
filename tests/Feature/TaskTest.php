<?php

namespace Tests\Feature;

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
}
