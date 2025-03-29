<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Http\Resources\TaskResources;
use App\Models\Task;
use App\Repositories\Task\TaskRepository;
use Illuminate\Http\JsonResponse;

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

        return response()->success(new TaskResources($task), 'Task created successfully');
    }

    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        $this->taskRepository->update($task, $request->validated());

        return response()->success(new TaskResources($task), 'Task updated successfully');
    }


    public function show(Task $task): JsonResponse
    {
        return response()->success(new TaskResources($task), 'Task retrieved successfully');
    }

    public function changeStatus(UpdateTaskStatusRequest $request, Task $task): JsonResponse
    {
        $this->taskRepository->update($task, $request->validated());

        return response()->success($task, 'Task updated successfully');

    }


    public function delete(Task $task): JsonResponse
    {
        $this->taskRepository->delete($task);

        return response()->success(new TaskResources($task), 'Task retrieved successfully');
    }

}
