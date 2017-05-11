<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Entity\Order;
use AppBundle\Form\OrderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * История заказов.
 *
 * @Route("history")
 */
class HistoryController extends Controller
{
    /**
     * Просмотр истории.
     *
     * @Route("/", name="history_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cars = $em->getRepository(Car::class)
            ->findAllWithModels();

        $orders = $em->getRepository(Order::class)
            ->findHistory();

        return $this->render('history/index.html.twig', [
            'cars'   => $cars,
            'orders' => $orders,
        ]);
    }

    /**
     * Таблица истории.
     *
     * @Route("/ajax", name="history_ajax")
     * @Method("GET")
     */
    public function ajaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $car = null;
        $carId = $request->query->get('car');

        if ($carId) {
            $car = $em->getRepository(Car::class)
                ->find($carId);
        }

        $orders = $em->getRepository(Order::class)
            ->findHistory($car);

        return $this->render('history/ajax.html.twig', [
            'orders' => $orders,
        ]);
    }

    /**
     * Добавление заказа.
     *
     * @Route("/new", name="history_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();

            $this->addFlash('success', 'Запись успешно создана!');

            return $this->redirectToRoute('history_index');
        }

        return $this->render('history/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
