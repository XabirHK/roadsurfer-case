<?php

namespace App\Controller;

use App\Entity\Station;
use App\Entity\Van;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VanController extends AbstractApiController
{
    public function indexAction(Request $request): Response
    {
        $van = $this->getDoctrine()->getRepository(Van::class)->findAll();
        return $this->json($van);
    }
}
