<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Equipment;
use App\Entity\Station;
use App\Utlis\CountEquipment;
use App\Utlis\Utlis;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class StationDashboardApiController extends AbstractApiController
{
    private Utlis $utlis;
    private CountEquipment $countEquipment;

    public function __construct()
    {
        $this->utlis = new Utlis();
        $this->countEquipment = new CountEquipment();
    }

    /**
     * @throws \Exception
     */
    public function findByStationAction(Request $request): Response
    {
        $stationId = $request->get('id');
        $station = $this->getDoctrine()->getRepository(Station::class)->findOneBy(['id' => $stationId]);

        $today = new DateTime();
        $today->format('Y-m-d');

        $next7Days = $this->utlis->next7Days($today);

        foreach ($next7Days as $day) {

            //initialization of Array for count
            $types = $this->getEquipmentsTypes();
            foreach ($types as $type){
                $type = $type['type'];
                $countInStation[$type] =null;
                $countInTransit[$type] = null;
            }

            $byEndStationBookings = $this->getDoctrine()->getRepository(Booking::class)->findAllByStartDateGreaterThan($today);

            if (!$byEndStationBookings !== null) {
                foreach ($byEndStationBookings as $booking) {
                    $equipments = $booking->getEquipments();

                    if (!$equipments !== null) {
                        foreach ($equipments as $equipment) {
                            $types = $this->getEquipmentsTypes();

                            foreach ($types as $type){
                                $type = $type['type'];
                                $countInStation[$type] += $this->countEquipment->countTypeInStation($booking, $day, $stationId, $equipment, $type);
                                $countInTransit[$type] += $this->countEquipment->countTypeInTransit($booking, $day, $stationId, $equipment, $type);
                            }
                        }
                    }
                }
            }

            $data[] = array(
                 'date' => $day,
                 'inStation' => $countInStation,
                 'inBooking' => $countInTransit,
            );

        }
        $stationData = array('id' => $station->getId(), 'name' => $station->getName(), 'status' => $data);

        return $this->respond($stationData);
    }

    public function getEquipmentsTypes(): ?array
    {
        return $this->getDoctrine()->getRepository(Equipment::class)->findAllType();
    }
}
