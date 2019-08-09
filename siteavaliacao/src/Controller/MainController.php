<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index()
    {
        if (!empty($this->getUser())) {
            return $this->redirectToRoute('dashboard');
        } else {
            return $this->redirectToRoute('login');
        }
    }
}
