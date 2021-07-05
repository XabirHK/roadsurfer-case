<?php

namespace App\Controller;

use App\Entity\Equipment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EquipmentController extends AbstractApiController
{
    public function indexAction(Request $request): Response
    {
        $equipment = $this->getDoctrine()->getRepository(Equipment::class)->findAll();
        return $this->json($equipment);
    }
}
