<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class HomeController extends AbstractController
{
    private $paramBag, $em, $validator,$security;
    public function __construct(EntityManagerInterface $em,
                                ParameterBagInterface  $parameterBag,
                                ValidatorInterface     $validator,
                                Security               $security
    )
    {
        $this->paramBag = $parameterBag;
        $this->em = $em;
        $this->validator = $validator;
        $this->security = $security;
    }

    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
}
