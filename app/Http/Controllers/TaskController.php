<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = Task::query()->where('user_id', 1)->get();

        return response()->success($tasks, 'tasks list received successfully');
    }
}
