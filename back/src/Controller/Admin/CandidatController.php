<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Entity\Candidat;
use App\Form\User\UserForm;
use App\Repository\AdminRepository;
use App\Repository\CandidatRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin/")]
class CandidatController extends AbstractController
{


}
