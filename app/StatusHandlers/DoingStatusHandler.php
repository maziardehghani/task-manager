<?php

namespace App\StatusHandlers;

use App\Enums\Statuses;
use App\Interfaces\StatusHandlerInterface;
use App\Models\Task;

class DoingStatusHandler implements StatusHandlerInterface
{

    public function handle(Task $task): void
    {
        $task->updateQuietly([
           'end_date' => null
        ]);
    }
}
