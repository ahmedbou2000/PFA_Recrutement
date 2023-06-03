<?php

namespace App\Controller\Candidat;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/candidat", name="home_candidat")
     */
    public function index(): Response
    {
        dd('home cadidat');
        return $this->render('recruteur/index.html.twig');
    }
}
