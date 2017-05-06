<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class HistoryController extends Controller
{
    /**
     * @Route("history", name="history")
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
     * @Route("history/ajax", name="history_ajax")
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
}
