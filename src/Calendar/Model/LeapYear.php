<?php

namespace Calendar\Model;

class LeapYear
{
    public function isLeapYear(int $year = null)
    {
        if (null === $year) {
            $year = date('Y');
        }

        return $year % 400 === 0 || ($year % 4 === 0 && $year % 100 !== 0);
    }
}
