<?php

namespace App\Interfaces;

use App\Models\Task;

interface StatusHandlerInterface
{
    public function handle(Task $task): void;
}
