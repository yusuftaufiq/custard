<?php

namespace Calendar\Controller;

use Calendar\Model\LeapYear;
use Symfony\Component\HttpFoundation\{Request, Response};

class LeapYearController
{
    public function index(Request $request, ?int $year): Response|string
    {
        $leapYear = new LeapYear();
        $content  = $leapYear->isLeapYear($year) ? 'Yep, this is a leap year!' : 'Nope, this is not a leap year.';
        $content .= rand();
        // $response = new Response($content);

        // $response->setTtl(10);

        // return $response;

        return $content;
    }
}
