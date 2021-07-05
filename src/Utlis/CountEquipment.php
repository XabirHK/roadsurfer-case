<?php


namespace App\Utlis;


use App\Controller\AbstractApiController;
use App\Entity\Booking;
use App\Entity\Equipment;
use DateTime;


class CountEquipment extends AbstractApiController
{
    public function countTypeInStation(Booking $booking, DateTime $day, int $stationId, Equipment $equipment, string $type): int
    {
        $count = 0;
        $bookingStartDate = $booking->getStartDate();
        $bookingEndDate = $booking->getEndDate();
        $bookingStartDate->format('Y-m-d:00:00:00');
        $bookingEndDate->format('Y-m-d:23:59:59');
        $day->format('Y-m-d:00:00:00');

        if (
            ($day >= $bookingEndDate || $day <= $bookingStartDate) &&
            $booking->getEndStation()->getId() === $stationId && $equipment->getType() === $type
        ) {
            $count = 1;
        }
        return $count;
    }

    public function countTypeInTransit(Booking $booking, DateTime $day, int $stationId, Equipment $equipment, $type): int
    {
        $count = 0;
        $bookingStartDate = $booking->getStartDate();
        $bookingEndDate = $booking->getEndDate();
        $bookingStartDate->format('Y-m-d:00:00:00');
        $bookingEndDate->format('Y-m-d:23:59:59');
        $day->format('Y-m-d:00:00:00');
        if (
            ($day >= $bookingStartDate && $day <= $bookingEndDate) &&
            $booking->getStartStation()->getId() === $stationId && $equipment->getType() === $type
        ) {
            $count = 1;
        }
        return $count;
    }

}