<?php

namespace App\Controller;

use App\Entity\Receita;
use App\Form\ReceitaType;
use App\Repository\ReceitaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/receita", name="receita.")
 */
class ReceitaController extends AbstractController
{
    /**
     * @Route("/cadastro", name="cadastro")
     */
    public function create(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $receita = new Receita();

        $form = $this->createForm(ReceitaType::class, $receita);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $receita->setUsuario($this->getUser());

            $entityManager->persist($receita);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('receita.cadastro'));
        }

        return $this->render('receita/cadastro.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/consulta", name="consulta")
     */
    public function view(ReceitaRepository $repository)
    {
        $receitas = $repository->findByUser($this->getUser()->getId());

        return $this->render('receita/consulta.html.twig', [
            'receitas' => $receitas
        ]);
    }
}
