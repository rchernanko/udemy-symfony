<?php

namespace CarBundle\Controller;

use CarBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends Controller
{
    /**
     * @Route("/our-cars", name="offer")
     */
    public function indexAction()
    {
        $carRepository = $this->getDoctrine()->getRepository(Car::class);
        $cars = $carRepository->findCarsWithDetails();

        //creating a search form (i just watched the video here + then copied and pasted his code)
        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('search', TextType::class)
            ->getForm();

        //now we need to pass our array (of cars) to a view - the second param in the render function below:
        return $this->render('CarBundle:Default:index.html.twig',
            [
                'cars' => $cars,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/car/{id}", name="show_car")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $carRepository = $this->getDoctrine()->getRepository(Car::class);
        $car = $carRepository->findCarWithDetailsById($id);
        return $this->render('CarBundle:Default:show.html.twig', ['car' => $car]);
    }
}