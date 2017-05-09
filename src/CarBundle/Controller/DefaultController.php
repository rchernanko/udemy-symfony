<?php

namespace CarBundle\Controller;

use CarBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/our-cars", name="offer")
     */
    public function indexAction()
    {
        $carRepository = $this->getDoctrine()->getRepository(Car::class);
        $cars = $carRepository->findAll();

        //now we need to pass our array to a view - the second param in the render function below:

        return $this->render('CarBundle:Default:index.html.twig', ['cars' => $cars]);
    }

    /**
     * @Route("/car/{id}", name="show_car")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $carRepository = $this->getDoctrine()->getRepository(Car::class);
        $car = $carRepository->find($id);
        return $this->render('CarBundle:Default:show.html.twig', ['car' => $car]);
    }
}