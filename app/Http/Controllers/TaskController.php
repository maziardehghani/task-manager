<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResources;
use App\Repositories\Task\TaskRepository;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{

    public function __construct(
        public TaskRepository $taskRepository,
    ){}

    public function index(): JsonResponse
    {
        $tasks = $this->taskRepository->getTasksOfUser(auth()->user());

        return response()->success(TaskResources::collection($tasks), 'tasks list received successfully');
    }


}
