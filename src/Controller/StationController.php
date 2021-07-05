<?php

namespace App\Controller;

use App\Entity\Station;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StationController extends AbstractApiController
{
    public function indexAction(Request $request): Response
    {
        $station = $this->getDoctrine()->getRepository(Station::class)->findAll();
        return $this->json($station);
    }
}
