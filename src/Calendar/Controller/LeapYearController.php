<?php

namespace Calendar\Controller;

use Calendar\Model\LeapYear;
use Symfony\Component\HttpFoundation\{Request, Response};

class LeapYearController
{
    public function index(Request $request, ?int $year)
    {
        $leapYear = new LeapYear();
        $content  = $leapYear->isLeapYear($year) ? 'Yep, this is a leap year!' : 'Nope, this is not a leap year.';
        $response = new Response($content . rand());

        $response->setTtl(10);

        return $response;
    }
}
