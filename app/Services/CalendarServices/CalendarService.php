<?php

namespace App\Services\CalendarServices;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;


class CalendarService
{
    static public function getPersianDate($date, $format = 'Y/m/d'): ?string
    {
        if (!$date) {
            return null;
        }
        return verta($date)->format($format);
    }

}
