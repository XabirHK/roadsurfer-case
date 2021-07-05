<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Equipment;
use App\Entity\Station;
use App\Utlis\Utlis;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StationDashboardController extends AbstractController
{
    private Utlis $utlis;

    public function __construct()
    {
        $this->utlis = new Utlis();
    }
    /**
     * @Route("/station/dashboard", name="station_dashboard")
     */
    public function index(): Response
    {
        $stations = $this->getDoctrine()->getRepository(Station::class)->findAll();
        return $this->render('station_dashboard/index.html.twig',  array ('stations'=>$stations));
    }

    /**
    * @Route("/station/dashboard/{id}", name="station_dashboard_status")
    */
    public function statusByStation(Request $request): Response
    {
        $stationId = $request->get('id');
        $station = $this->getDoctrine()->getRepository(Station::class)->findOneBy(['id' => $stationId]);

        $today = new DateTime();
        $today->format('Y-m-d');

        $next7Days = $this->utlis->next7Days($today);

        foreach ($next7Days as $day) {

            $chairInStation = 0;
            $chairInTransit = 0;
            $bedInStation = 0;
            $bedInTransit = 0;
            $deskInStation = 0;
            $deskInTransit = 0;

            $byEndStationBookings = $this->getDoctrine()->getRepository(Booking::class)->findAllByStartDateGreaterThan($today);

            if (!$byEndStationBookings !== null) {
                foreach ($byEndStationBookings as $booking) {
                    $equipments = $booking->getEquipments();

                    if (!$equipments !== null) {
                        foreach ($equipments as $equipment) {
                            $chairInStation += $this->countChairInStation($booking, $day, $stationId, $equipment);
                            $chairInTransit += $this->countChairInTransit($booking, $day, $stationId, $equipment);
                            $bedInStation = $this->countBedInStation($booking, $day, $stationId, $equipment);
                            $bedInTransit = $this->countBedInTransit($booking, $day, $stationId, $equipment);
                            $deskInStation = $this->countDeskInStation($booking, $day, $stationId, $equipment);
                            $deskInTransit = $this->countDeskInTransit($booking, $day, $stationId, $equipment);
                        }
                    }
                }
            }

            $data[] = array(
                'date' => $day,
                'chairInStation' => $chairInStation,
                'bedInStation' => $deskInStation,
                'deskInStation' => $bedInStation,
                'chairInBooking' => $chairInTransit,
                'bedInBooking' => $bedInTransit,
                'deskInBooking' => $deskInTransit
            );

        }
        $stationData = array('id' => $station->getId(), 'name' => $station->getName(), 'status' => $data);

        return $this->render('station_dashboard/status.html.twig',  array ('station'=>$stationData));
    }

    public function countChairInStation(Booking $booking, DateTime $day, int $stationId, Equipment $equipment): int
    {
        $count = 0;
        $bookingStartDate = $booking->getStartDate();
        $bookingEndDate = $booking->getEndDate();
        $bookingStartDate->format('Y-m-d:00:00:00');
        $bookingEndDate->format('Y-m-d:23:59:59');
        $day->format('Y-m-d:00:00:00');

        if (
            ($day >= $bookingEndDate || $day <= $bookingStartDate) &&
            $booking->getEndStation()->getId() == $stationId && $equipment->getType() == Equipment::TYPE_CHAIR
        ) {
            $count = 1;
        }
        return $count;
    }

    public function countChairInTransit(Booking $booking, DateTime $day, int $stationId, Equipment $equipment): int
    {
        $count = 0;
        $bookingStartDate = $booking->getStartDate();
        $bookingEndDate = $booking->getEndDate();
        $bookingStartDate->format('Y-m-d:00:00:00');
        $bookingEndDate->format('Y-m-d:23:59:59');
        $day->format('Y-m-d:00:00:00');
        if (
            ($day >= $bookingStartDate && $day <= $bookingEndDate) &&
            $booking->getStartStation()->getId() === $stationId && $equipment->getType() === Equipment::TYPE_CHAIR
        ) {
            $count = 1;
        }
        return $count;
    }

    public function countBedInStation(Booking $booking, DateTime $day, int $stationId, Equipment $equipment): int
    {
        $count = 0;
        $bookingStartDate = $booking->getStartDate();
        $bookingEndDate = $booking->getEndDate();
        $bookingStartDate->format('Y-m-d:00:00:00');
        $bookingEndDate->format('Y-m-d:23:59:59');
        $day->format('Y-m-d:00:00:00');

        if (
            ($day >= $bookingEndDate || $day <= $bookingStartDate) &&
            $booking->getEndStation()->getId() == $stationId && $equipment->getType() == Equipment::TYPE_BED
        ) {
            $count = 1;
        }
        return $count;
    }

    public function countBedInTransit(Booking $booking, DateTime $day, int $stationId, Equipment $equipment): int
    {
        $count = 0;
        $bookingStartDate = $booking->getStartDate();
        $bookingEndDate = $booking->getEndDate();
        $bookingStartDate->format('Y-m-d:00:00:00');
        $bookingEndDate->format('Y-m-d:23:59:59');
        $day->format('Y-m-d:00:00:00');
        if (
            ($day >= $bookingStartDate && $day <= $bookingEndDate) &&
            $booking->getStartStation()->getId() === $stationId && $equipment->getType() === Equipment::TYPE_BED
        ) {
            $count = 1;
        }
        return $count;
    }

    public function countDeskInStation(Booking $booking, DateTime $day, int $stationId, Equipment $equipment): int
    {
        $count = 0;
        $bookingStartDate = $booking->getStartDate();
        $bookingEndDate = $booking->getEndDate();
        $bookingStartDate->format('Y-m-d:00:00:00');
        $bookingEndDate->format('Y-m-d:23:59:59');
        $day->format('Y-m-d:00:00:00');

        if (
            ($day >= $bookingEndDate || $day <= $bookingStartDate) &&
            $booking->getEndStation()->getId() == $stationId && $equipment->getType() == Equipment::TYPE_DESK
        ) {
            $count = 1;
        }
        return $count;
    }

    public function countDeskInTransit(Booking $booking, DateTime $day, int $stationId, Equipment $equipment): int
    {
        $count = 0;
        $bookingStartDate = $booking->getStartDate();
        $bookingEndDate = $booking->getEndDate();
        $bookingStartDate->format('Y-m-d:00:00:00');
        $bookingEndDate->format('Y-m-d:23:59:59');
        $day->format('Y-m-d:00:00:00');
        if (
            ($day >= $bookingStartDate && $day <= $bookingEndDate) &&
            $booking->getStartStation()->getId() === $stationId && $equipment->getType() === Equipment::TYPE_DESK
        ) {
            $count = 1;
        }
        return $count;
    }

}
