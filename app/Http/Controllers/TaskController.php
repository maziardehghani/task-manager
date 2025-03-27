<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResources;
use App\Repositories\Task\TaskRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct(
        public TaskRepository $taskRepository,
    ){}

    public function index(SearchTaskRequest $request): JsonResponse
    {
        $tasks = $this->taskRepository->getTasksOfUser(auth()->user(), $request->validated());

        return response()->success(TaskResources::collection($tasks), 'tasks list received successfully');
    }

    public function store(TaskRequest $request): JsonResponse
    {
        $task = $this->taskRepository->store($request->validated());

        return response()->success($task, 'Task created successfully');
    }

}
