<?php

namespace App\Controller;

use App\Entity\Van;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VanController extends AbstractApiController
{
    public function indexAction(Request $request): Response
    {
        $van = $this->getDoctrine()->getRepository(Van::class)->findAll();
        return $this->json($van);
    }
}
