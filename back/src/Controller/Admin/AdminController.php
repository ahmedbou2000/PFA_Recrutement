<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Form\User\UserForm;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/admin', name: 'admin_admins')]
    public function index(Request $request,AdminRepository $adminRepository,Security $security,EntityManagerInterface $entityManager): Response
    {
        $nom = '';$page = 1;
        if(isset($_GET['nom'])) $nom = $_GET['nom'];
        if(isset($_GET['page'])) $page = $_GET['page'];

        $admins = $adminRepository->getAdminParNom($nom,$page);

        $admin = new Admin();
        $adminForm = $this->createForm(UserForm::class,$admin);
        $adminForm->handleRequest($request);

        if($adminForm->isSubmitted() && $adminForm->isValid()){
            $data = $adminForm->getData();
            $entityManager->persist($data);
            $entityManager->flush();
            $this->addFlash('success','Ajouter avec succes');
            return $this->redirectToRoute($request->attributes->get('_route'));
        }

        return $this->render('admin/admin/index.html.twig',
        [
            'admins'=>$admins,
            'totalResult'=>$admins->getTotalItemCount(),
            'formAdmin'=>$adminForm->createView()
        ]);
    }

}
