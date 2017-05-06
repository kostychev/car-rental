<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Form\CarType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("cars")
 */
class CarsController extends Controller
{
    /**
     * @Route("/", name="cars")
     */
    public function indexAction()
    {
        $cars = $this->getDoctrine()->getManager()
            ->getRepository(Car::class)
            ->findAllWithModels();

        return $this->render('cars/index.html.twig', [
            'cars' => $cars,
        ]);
    }

    /**
     * @Route("/new", name="new_car")
     */
    public function newAction(Request $request)
    {
        return $this->handleForm($request, new Car(), 'Запись успешно создана!');
    }

    /**
     * @Route("/{id}/edit", name="edit_car")
     */
    public function editAction(Request $request, Car $car)
    {
        return $this->handleForm($request, $car, 'Запись успешно обновлена!');
    }

    private function handleForm(Request $request, Car $car, $flashMessage)
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            if ($flashMessage) {
                $this->addFlash('success', $flashMessage);
            }

            return $this->redirectToRoute('cars');
        }

        return $this->render('cars/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
