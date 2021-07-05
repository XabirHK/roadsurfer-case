<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Equipment;
use App\Entity\EquipmentBooking;
use App\Form\Type\BookingType;
use Doctrine\Common\Collections\ArrayCollection;
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

    public function createAction( Request $request) : Response
    {

        $form = $this->buildForm(BookingType::class);
        $form->handleRequest($request);
        if(!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        /** @var Booking $booking */
        $booking = $form->getData();

        $rentedEquipments = $booking->getEquipments();

        //set equipment status to in transit
        foreach ($rentedEquipments as $rentedEquipment){
            $equipment = $this->getDoctrine()->getRepository(Equipment::class)->find(['id' => $rentedEquipment->getId()]);
            $equipment->setStatus(Equipment::STATUS_INTRANSIT);
            $this->getDoctrine()->getManager()->persist($equipment);
            $this->getDoctrine()->getManager()->flush();
        }

        $this->getDoctrine()->getManager()->persist($booking);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond($booking);

    }
}
