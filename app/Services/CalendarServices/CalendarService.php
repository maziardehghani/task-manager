<?php

namespace App\Services\CalendarServices;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;


class CalendarService
{
    static public function formatter($date): ?string
    {
        if (!$date) {
            return null;
        }

        return Carbon::make($date)->format('Y-m-d');
    }

}
