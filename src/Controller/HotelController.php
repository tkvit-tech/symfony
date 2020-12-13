<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hotel;
use App\Entity\HotelRoom;
use App\Entity\Review;
use App\Form\ReviewType;

class HotelController extends AbstractController
{
    /**
     * @Route("/hotel/{city}", name="hotel")
     */
    public function index(Request $request, $city): Response
    {
        $hotels = $this->getDoctrine()->getRepository(Hotel::class)->findCityHotels($city);
        return $this->render('hotel/index.html.twig', [
            'controller_name' => 'HotelController',
            'hotels' => $hotels
        ]);
    }
    /**
     * @Route("/hotel_desc/{hotel_id}", name="hotel_desc")
     */
    public function hotelDesc(Request $request, $hotel_id)
    {
        $hotel = $this->getDoctrine()->getRepository(Hotel::class)->find($hotel_id);
        $rooms = $this->getDoctrine()->getRepository(HotelRoom::class)->findBy(['hotel' => $hotel_id]);
        $services = $this->getDoctrine()->getRepository(Hotel::class)->findServices($hotel_id);
        $reviews = $this->getDoctrine()->getRepository(Review::class)->findBy(['hotel' => $hotel_id], ['id' => 'DESC']);

        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $review->setHotel($hotel);
            $this->getDoctrine()->getManager()->persist($review);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('hotel_desc', ["hotel_id" => $hotel_id]);
        }

        return $this->render('hotel/desc.html.twig', [
            'controller_name' => 'HotelController',
            'hotel' => $hotel,
            'rooms' => $rooms,
            'services' => $services,
            'review_form' => $form->createView(),
            'reviews' => $reviews,
        ]);

    }
}
