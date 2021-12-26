<?php

namespace App\Http\Calendar\Model;

class LeapYear
{
    public function isLeapYear(int $year): bool
    {
        return $year % 400 === 0 || ($year % 4 === 0 && $year % 100 !== 0);
    }
}
