<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Equipment;
use App\Entity\Station;
use App\Service\StationDashboardService;
use App\Utlis\CountEquipment;
use App\Utlis\Utlis;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class StationDashboardApiController extends AbstractApiController
{

    public function findByStationAction(Request $request, StationDashboardService $stationDashboardService): Response
    {
        $stationId = $request->get('id');

        $stationData = $stationDashboardService->findByStationService($stationId);

        return $this->respond($stationData);
    }

}
