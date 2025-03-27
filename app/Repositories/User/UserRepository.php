<?php

namespace App\Repositories\User;

use App\Interfaces\Repository;
use App\Models\User;

class UserRepository extends Repository {

      public function __construct()
      {
          $this->model = User::query();
      }

      public function findByEmail(string $email): ?User
      {
          return $this->model->whereEmail($email)->firstOrFail();
      }

}

