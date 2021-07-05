<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StationDashboardController extends AbstractController
{
    /**
     * @Route("/station/dashboard", name="station_dashboard")
     */
    public function index(): Response
    {
        return $this->render('station_dashboard/index.html.twig', [
            'controller_name' => 'StationDashboardController',
        ]);
    }
}
