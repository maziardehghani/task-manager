<?php

namespace App\Repositories\Task;
use App\Interfaces\Repository;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository extends Repository {

      public function __construct()
      {
          $this->model = Task::query();
      }

      public function getTasksOfUser($user)
      {
          return $this->model
              ->whereUser($user)
              ->latest()
              ->paginate();
      }

}

