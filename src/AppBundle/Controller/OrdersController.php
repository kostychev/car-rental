<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Form\OrderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends Controller
{
    /**
     * @Route("orders", name="orders")
     */
    public function indexAction()
    {
//        $orders = $this->getDoctrine()->getManager()
//            ->getRepository(Order::class)
//            ->findActive();

        $orders = [];

        return $this->render('orders/index.html.twig', [
            'orders' => $orders,
        ]);
    }

    /**
     * @Route("orders/new", name="new_order")
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

            return $this->redirectToRoute('orders');
        }

        return $this->render('orders/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
