<?php

namespace App\Controller;

use App\Entity\Despesa;
use App\Form\DespesaType;
use App\Repository\DespesaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/despesa", name="despesa.")
 */
class DespesaController extends AbstractController
{
    /**
     * @Route("/cadastro", name="cadastro")
     */
    public function create(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $despesa = new Despesa();

        $form = $this->createForm(DespesaType::class, $despesa);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $despesa->setUsuario($this->getUser());

            $entityManager->persist($despesa);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('despesa.cadastro'));
        }

        return $this->render('despesa/cadastro.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/consulta", name="consulta")
     */
    public function view(DespesaRepository $repository)
    {
        $despesas = $repository->findByUser($this->getUser()->getId());

        return $this->render('despesa/consulta.html.twig', [
            'despesas' => $despesas
        ]);
    }
}
