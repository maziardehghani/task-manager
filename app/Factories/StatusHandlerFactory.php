<?php

namespace App\Factories;

use App\Interfaces\StatusHandlerInterface;
use App\StatusHandlers\DoingStatusHandler;
use App\StatusHandlers\DoneStatusHandler;
use App\StatusHandlers\TodoStatusHandler;

class StatusHandlerFactory
{
    public static function make(string $status): StatusHandlerInterface
    {
        return match($status) {
            'todo' => app(TodoStatusHandler::class),
            'doing' => app(DoingStatusHandler::class),
            'done' => app(DoneStatusHandler::class),
            default => throw new \InvalidArgumentException("Invalid status")
        };
    }
}
