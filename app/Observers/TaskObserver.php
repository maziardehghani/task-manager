<?php

namespace App\Observers;

use App\Factories\StatusHandlerFactory;
use App\Models\Task;

class TaskObserver
{
    public function creating(Task $task): void
    {
        $task->user_id = $task->user_id ?? auth()->id();
    }

    public function created(Task $task): void
    {

    }

    /**
     * Handle the Task "updated" event.
     */
    public function updating(Task $task): void
    {

    }


    public function updated(Task $task): void
    {
        if ($task->wasChanged('status')) {
            $handler = StatusHandlerFactory::make($task->status);
            $handler->handle($task);
        }
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
