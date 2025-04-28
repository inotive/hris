<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateFormatHelper 
{
    static public function format($date) 
    {
        $date = Carbon::parse($date);
        return $date->format('d M Y');
    }

    static public function formatTime($date) 
    {
        $date = Carbon::parse($date);
        return $date->format('H:i');
    }

    static public function formatWithTime($date) 
    {
        $date = Carbon::parse($date);
        return $date->format('d M Y H:i:s');
    }
}