<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Form\ClientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/clients")
 */
class ClientsController extends Controller
{
    /**
     * @Route("/", name="clients")
     */
    public function indexAction()
    {
        $clients = $this->getDoctrine()->getManager()
            ->getRepository(Client::class)
            ->findAll();

        return $this->render('clients/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    /**
     * @Route("/new", name="new_client")
     */
    public function newAction(Request $request)
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            $this->addFlash('success', 'Запись успешно создана!');

            return $this->redirectToRoute('clients');
        }

        return $this->render('clients/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit_client")
     */
    public function editAction(Request $request, Client $client)
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Запись успешно обновлена!');

            return $this->redirectToRoute('clients');
        }

        return $this->render('clients/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
