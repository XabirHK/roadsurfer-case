<?php


namespace App\Service;


use App\Entity\Booking;
use App\Entity\Equipment;
use App\Entity\Station;
use App\Utlis\CountEquipment;
use App\Utlis\Utlis;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;


class StationDashboardService
{
    private Utlis $utlis;
    private CountEquipment $countEquipment;
    private EntityManagerInterface $em;


    public function __construct(Utlis $utils, CountEquipment $countEquipment, EntityManagerInterface $em)
    {
        $this->utlis = $utils;
        $this->countEquipment = $countEquipment;
        $this->em = $em;
    }

    /**
     * @throws \Exception
     */
    public function findByStationService(int $id): array
    {
        $stationId = $id;


        $station = $this->em->getRepository(Station::class)->findOneBy(['id' => $stationId]);

        $today = new DateTime();
        $today->format('Y-m-d');

        $next7Days = $this->utlis->next7Days($today);

        foreach ($next7Days as $day) {

            //initialization of Array for count
            $types = $this->getEquipmentsTypes();
            foreach ($types as $type) {
                $type = $type['type'];
                $countInStation[$type] = null;
                $countInTransit[$type] = null;
            }

            $byEndStationBookings = $this->em->getRepository(Booking::class)->findAllByStartDateGreaterThan($today);

            if (!$byEndStationBookings !== null) {
                foreach ($byEndStationBookings as $booking) {
                    $equipments = $booking->getEquipments();

                    if (!$equipments !== null) {
                        foreach ($equipments as $equipment) {
                            $types = $this->getEquipmentsTypes();

                            foreach ($types as $type) {
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
        return array('id' => $station->getId(), 'name' => $station->getName(), 'status' => $data);
    }

    /**
     * @throws \Exception
     */
    public function getEquipmentsTypes(): ?array
    {
        return $this->em->getRepository(Equipment::class)->findAllType();
    }

}