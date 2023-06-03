<?php

namespace App\Controller\Admin;

use App\Entity\Profil;
use App\Repository\CandidatRepository;
use App\Repository\DomaineRepository;
use App\Repository\ProfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin/")]
class ProfilController extends AbstractController
{
    #[Route('profils', name: 'admin_profils')]
    public function index(ProfilRepository $profilRepository,DomaineRepository $domaineRepository): Response
    {
        $nom = $_GET['nom'] ?? '';
        $page = $_GET['page'] ?? 1;
        $minAge = $_GET['minAge'] ?? 0;
        $maxAge = $_GET['maxAge'] ?? 999;
        $domaine = $_GET['domaine'] ?? 'p.domaine';

        $minAge = empty($minAge) ? 0 : $minAge;
        $maxAge = empty($maxAge) ? 999 : $maxAge;
        $domaine = empty($domaine) ? 'p.domaine' : $domaine;

        $profils = $profilRepository->getProfilParCriteres($nom,$page,$minAge,$maxAge,$domaine);

        $domaines = $domaineRepository->findAll();
        return $this->render('admin/profil/index.html.twig',
            [
                'profils'=>$profils,
                'domaines'=>$domaines,
                'totalResult'=>$profils->getTotalItemCount(),
            ]);
    }


    #[Route('change-etat-profil/{id}', name: 'change-etat-profil')]
    public function changeEtatProfil(int $id,Request $request,ProfilRepository $profilRepository): RedirectResponse
    {
        $profil = $profilRepository->find($id);
        $profil->changeEtat();
        $profilRepository->add($profil,true);
        return $this->redirect($request->server->get('HTTP_REFERER'));
    }


    #[Route('details-profil/{id}', name: 'details-profil')]
    public function detailsProfil(Profil $profilDetails)
    {
        return $this->render('admin/profil/profil-details.html.twig',
        [
            'profil'=>$profilDetails
        ]);
    }
}