<?php

namespace App\Http\Controllers;

use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::query()->where('user_id', 1)->get();

        return response()->json($tasks, 200);
    }
}
