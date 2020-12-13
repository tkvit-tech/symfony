<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelRoomController extends AbstractController
{
    /**
     * @Route("/hotel/room", name="hotel_room")
     */
    public function index(): Response
    {
        return $this->render('hotel_room/index.html.twig', [
            'controller_name' => 'HotelRoomController',
        ]);
    }
}
