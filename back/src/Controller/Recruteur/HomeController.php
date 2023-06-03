<?php

namespace App\Controller\Recruteur;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/recruteur", name="home_recruteur")
     */
    public function index(): Response
    {
        dd('home recrurter');
        return $this->render('recruteur/index.html.twig');
    }
}
