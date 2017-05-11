<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Form\CarType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Управление автомобилями.
 *
 * @Route("car")
 */
class CarController extends Controller
{
    /**
     * Список всех авто.
     *
     * @Route("/", name="car_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $cars = $this->getDoctrine()->getManager()
            ->getRepository(Car::class)
            ->findAllWithModels();

        return $this->render('car/index.html.twig', [
            'cars' => $cars,
        ]);
    }

    /**
     * Создание авто.
     *
     * @Route("/new", name="car_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            $this->addFlash('success', 'Запись успешно создана!');

            return $this->redirectToRoute('car_index');
        }

        return $this->render('car/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Редактирование авто.
     *
     * @Route("/{id}/edit", name="car_edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Car $car)
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            $this->addFlash('success', 'Запись успешно обновлена!');

            return $this->redirectToRoute('car_index');
        }

        return $this->render('car/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
