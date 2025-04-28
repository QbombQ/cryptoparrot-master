<?php

namespace App\Model\Facades;

use Carbon\Carbon;

class Time {

    public static function formatDateDiffForHumans($date)
    {

        $carbonDate = Carbon::parse($date);

		return $carbonDate->diffInDays() < 10 ? $carbonDate->diffForHumans() : $carbonDate->toDateString();

    }
    
    public static function formatDateForHumans($date, $format = 'j M, Y')
    {

        $carbonDate = Carbon::parse($date);

		return $carbonDate->diffInDays() < 10 ? $carbonDate->diffForHumans() : $carbonDate->format($format);

    }

}