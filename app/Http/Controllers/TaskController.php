<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Repositories\Task\TaskRepository;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{

    public function __construct(
        public TaskRepository $taskRepository,
    ){}
    public function index(): JsonResponse
    {
        $tasks = $this->taskRepository->getTasksOfUser(User::first());

        return response()->success($tasks, 'tasks list received successfully');
    }
}
