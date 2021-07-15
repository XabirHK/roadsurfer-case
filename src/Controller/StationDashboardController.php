<?php

namespace App\Controller;


use App\Entity\Station;
use App\Service\StationDashboardService;
use App\Utlis\CountEquipment;
use App\Utlis\Utlis;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StationDashboardController extends AbstractController
{
    private Utlis $utlis;
    private CountEquipment $countEquipment;

    public function __construct()
    {
        $this->utlis = new Utlis();
        $this->countEquipment = new CountEquipment();
    }

    /**
     * @Route("/station/dashboard", name="station_dashboard")
     */
    public function index(): Response
    {
        $stations = $this->getDoctrine()->getRepository(Station::class)->findAll();
        return $this->render('station_dashboard/index.html.twig', array('stations' => $stations));
    }

    /**
     * @Route("/station/dashboard/{id}", name="station_dashboard_status")
     */
    public function statusByStation(Request $request, StationDashboardService $stationDashboardService): Response
    {
        $stationId = $request->get('id');

        $stationData = $stationDashboardService->findByStationService($stationId);

        return $this->render('station_dashboard/status.html.twig', array('station' => $stationData));
    }
}
