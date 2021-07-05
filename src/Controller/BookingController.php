<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Equipment;
use App\Form\Type\BookingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BookingController extends AbstractApiController
{
    public function indexAction(Request $request): Response
    {
        $booking = $this->getDoctrine()->getRepository(Booking::class)->findAll();
        return $this->respond($booking);
    }

    public function findByIdAction(Request $request): Response
    {
        $bookingId = $request->get('id');
        $booking = $this->getDoctrine()->getRepository(Booking::class)->findOneBy(['id' => $bookingId]);
        return $this->respond($booking);
    }

    public function createAction(Request $request): Response
    {

        $form = $this->buildForm(BookingType::class);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        /** @var Booking $booking */
        $booking = $form->getData();

        $this->getDoctrine()->getManager()->persist($booking);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond($booking);

    }
}
