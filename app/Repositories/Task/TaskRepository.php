<?php

namespace App\Repositories\Task;
use App\Interfaces\Repository;
use App\Models\Task;

class TaskRepository extends Repository {

      public function __construct()
      {
          $this->model = Task::query();
      }

}

