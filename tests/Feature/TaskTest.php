<?php

namespace Feature;

use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_each_user_can_see_his_tasks(): void
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);
    }
}
