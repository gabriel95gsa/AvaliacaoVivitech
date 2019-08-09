<?php

namespace App\Controller;

use App\Repository\DespesaRepository;
use App\Repository\ReceitaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(DespesaRepository $despesaRepository, ReceitaRepository $receitaRepository)
    {
        $user = $this->getUser()->getId();

        $despesas = $despesaRepository->findByMesAtual($user);
        $totalDespesas = 0;
        foreach ($despesas as $despesa) {
            $totalDespesas += $despesa->getValor();
        }

        $receitas = $receitaRepository->findByMesAtual($user);
        $totalReceitas = 0;
        foreach ($receitas as $receita) {
            $totalReceitas += $receita->getValor();
        }

        return $this->render('dashboard/index.html.twig', [
            'valor_despesas_mes' => $totalDespesas,
            'valor_receitas_mes' => $totalReceitas,
            'saldo_mes' => $totalReceitas - $totalDespesas
        ]);
    }
}
