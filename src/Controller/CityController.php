<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\City;
use Knp\Component\Pager\PaginatorInterface;

class CityController extends AbstractController
{
    /**
     * @Route("/city/{page}", name="city")
     */
    public function index(Request $request, PaginatorInterface $paginator, $page = ''): Response
    {
        $queryBuilder = $this->getDoctrine()->getRepository(City::class)->getCityList();
        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            //$request->query->getInt('page', 1)/*page number*/,
            $page = ((int)$page == false)?1:(int)$page,
            3,/*limit per page*/
        );
        //dump($pagination);die();
        return $this->render('city/index.html.twig', [
            'controller_name' => 'CityController',
            'pagination' =>$pagination,
            'cities' => array()
        ]);
    }
}
