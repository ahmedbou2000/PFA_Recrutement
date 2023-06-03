<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
    #[Route('/admin/offre', name: 'admin_offres')]
    public function index(): Response
    {

        return $this->render('admin/offre/index.html.twig');
    }
}
