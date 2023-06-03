<?php

namespace App\Controller\Candidat;

use App\Entity\Profil;
use App\Repository\ProfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProfilType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('profil/modifier/{id}', name: 'modifier-profil')]
    public function edit(Profil $profil, Request $request, EntityManagerInterface $manager) : Response
    {

        $form = $this->createForm(ProfilType::class , $profil);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $profil =$form->getData();

            $manager->persist($profil);
            $manager->flush();

            $this->addFlash('Success' , 'Votre profile a été modifié avec success !');

        }

        return $this->render('Candidat/modifierProfil.html.twig', [
            'form' =>$form->createView()
        ]);
    }
}
