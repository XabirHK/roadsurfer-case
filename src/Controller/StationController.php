<?php

namespace App\Controller;

use App\Entity\Station;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StationController extends AbstractApiController
{
    public function indexAction(Request $request): Response
    {
        $station = $this->getDoctrine()->getRepository(Station::class)->findAll();
        return $this->json($station);
    }
}
