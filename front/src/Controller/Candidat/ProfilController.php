<?php

namespace App\Controller\Candidat;
use App\Repository\ProfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProfilType;
use Symfony\Component\HttpFoundation\Response ;

#[Route("/Candidat/")]
class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProfilController.php',
        ]);
    }

    #[Route('modifier/{idProfil}', name: 'modifier-profil')]
    public function edit(int $idProfil, ProfilRepository $repository) : Response
    {
        $profil = $repository->findOneBy(['id'=>$idProfil]);

        $form = $this->createForm(ProfilType::class , $profil);
        return $this->render('Candidat/modifierProfil.html.twig', [
            'form' =>$form->createView()
        ]);
    }
}
