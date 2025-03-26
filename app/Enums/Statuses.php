<?php

namespace App\Enums;

enum Statuses : string
{
    case DOING = 'doing';
    case DONE = 'done';
    case TODO = 'todo';

    public static function taskStatuses(): array
    {
        return [
            self::DOING->value,
            self::DONE->value,
            self::TODO->value,
        ];
    }
}
