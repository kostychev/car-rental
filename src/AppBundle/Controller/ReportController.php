<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportController extends Controller
{
    /**
     * @Route("/report", name="report")
     */
    public function indexAction()
    {
        $data = $this->getDoctrine()->getManager()
            ->getRepository(Order::class)
            ->reportByDurationForOfficeAndBrand();

        return $this->render('report/index.html.twig', [
            'data' => $data,
        ]);
    }
}
