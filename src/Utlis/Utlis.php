<?php


namespace App\Utlis;


use DateInterval;
use DatePeriod;
use DateTime;

class Utlis
{
    /**
     * @throws \Exception
     */
    public function next7Days(\DateTime $dateStart): array
    {
        $days   = [];
        $period = new DatePeriod(
            new DateTime(), // Start date of the period
            new DateInterval('P1D'), // Define the intervals as Periods of 1 Day
            7 // Apply the interval 7 times on top of the starting date
        );

        foreach ($period as $day)
        {
            $days[] = new DateTime($day->format('Y-m-d')) ;
        }
        return  $days;
    }

}