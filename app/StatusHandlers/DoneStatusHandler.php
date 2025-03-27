<?php

namespace App\StatusHandlers;

use App\Interfaces\StatusHandlerInterface;
use App\Models\Task;
use Carbon\Carbon;

class DoneStatusHandler implements StatusHandlerInterface
{

    public function handle(Task $task): void
    {
        $task->updateQuietly([
            'end_date' => Carbon::now()
        ]);
    }
}
