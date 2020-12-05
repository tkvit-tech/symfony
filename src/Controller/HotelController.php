<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hotel;

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
        $hotel = $this->getDoctrine()->getRepository(Hotel::class)->findHotel($hotel_id)[0];
        return $this->render('hotel/desc.html.twig', [
            'controller_name' => 'HotelController',
            'hotel' => $hotel
        ]);
    }
}
