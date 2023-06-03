<?php

namespace App\Controller\Security;

use App\Entity\Admin;
use App\Entity\Candidat;
use App\Entity\Recruteur;
use App\Entity\User;
use App\Form\User\UserForm;
use App\Form\User\LoginForm;
use App\Form\User\RecruteurForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UsersController extends AbstractController
{
    private $em;
    private $security;
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $em, Security $security)
    {
        $this->security = $security;
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
    }


    #[Route("/admin/change-etat-user/{id}" , name:"change-etat-user")]
    public function changeEtatUser($id,Request $request){
        $user = $this->em->find(User::class,$id);
        $user->changeEtat();
        $this->em->persist($user);
        $this->em->flush();
        return $this->redirect($request->server->get('HTTP_REFERER'));
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils,Request $request): Response
    {
        $recruteur = new Recruteur();
        $formRecruteur = $this->createForm(RecruteurForm::class, $recruteur);
        $formRecruteur->handleRequest($request);

        if ($formRecruteur->isSubmitted() && $formRecruteur->isValid()) {
            $data = $formRecruteur->getData();
            $this->em->persist($data);
            $this->em->flush();
        }

        $candidat = new Candidat();
        $formCandidat = $this->createForm(UserForm::class, $candidat);
        $formCandidat->handleRequest($request);

        if ($formCandidat->isSubmitted() && $formCandidat->isValid()) {
            $data = $formCandidat->getData();
            $this->em->persist($data);
            $this->em->flush();
        }



        $user = new User();
        $userForm = $this->createForm(LoginForm::class, $user);


        $lastuser = $authenticationUtils->getLastUsername();
        $erreurs = $authenticationUtils->getLastAuthenticationError();

        return $this->render('login/login.html.twig',
            [
                'last_username' => $lastuser,
                'erreurs' => $erreurs,
                'formRecruteur' => $formRecruteur->createView(),
                'formCandidat' => $formCandidat->createView(),
                'userForm' => $userForm->createView(),
            ]
        );
    }

    /**
     * @Route("/loginCheck", name="loginCheck")
     */
    public function loginCheck(Security $security)
    {
        $user = $security->getUser();

        $route = 'home';
        if ($user instanceof Candidat)
            $route = 'home_candidat';

        else if ($user instanceof Recruteur)
            $route = 'home_recruteur';

        else if ($user instanceof Admin)
            $route = 'home_admin';

        return $this->redirectToRoute($route);
    }

    /**
     * @Route("/inscrireCandidat", name="inscrire")
     */
    public function inscrire(Request $request)
    {

    }

    /**
     * @Route("/CodeReset", name="coderesetcode")
     */
    public function coderesetcode(AuthenticationUtils $auth, Request $request)
    {
        try {
            $data = json_decode($request->getContent());

            $user = $this->em->getRepository(User::class)->checkCodeResetUser($data->code);
            if (count($user) == 1) {
                $u = $this->em->find(User::class, $data->idUser);
                $u->setLink(null);
                $u->setDateLink(null);
                $u->setPassword($this->passwordEncoder->encodePassword($u, $data->password));
                $this->login($auth);
                $this->em->persist($u);
                $this->em->flush();

                return new Response('Success!', Response::HTTP_OK);
            } else {
                return new Response('Code invalide!', Response::HTTP_BAD_REQUEST);
            }

        } catch (\Exception $ex) {
            return new Response('Un erreur survenu!', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/CodeForgetPassword", name="CodeForgetPassword")
     */
    public function CodeForgetPassword(Request $request): Response
    {
        try {
            $email = $request->getContent();
            $count = $this->em->getRepository(User::class)->count(['email' => $email]);
            if ($count == 0) {
                return new Response('Email n\'existe pas !', Response::HTTP_BAD_REQUEST);
            } else {
                $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
                $url = 'https://' . $_SERVER["SERVER_NAME"] . '/reset/';
                $randString = '';
                $allChar = 'JKLMWXazertyusd56fghjkIOPQSDFGlmwxcvbn1234iopq79AZERTYUCV8N';
                for ($i = 0; $i < 100; $i++) {
                    $rand = rand(0, strlen($allChar) - 1);
                    $randString .= $allChar[$rand];
                }
                $fullUrl = $url . $randString;
                $u = $this->em->find(User::class, $user->getId());
                $u->setLink($fullUrl);
                $u->setDateLink(new \DateTime('now'));
                $this->em->persist($u);

                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                //mail($user->getEmail(), 'TECHNOLOGICA : Réinitialiser du mot de passe',$fullUrl);
                $this->em->flush();
                return new Response('Email envoyer avec success!', Response::HTTP_OK);

            }
        } catch (\Exception $ex) {
            return new Response($ex->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): void
    {
    }

    /**
     * @Route("/compteDesactive", name="compteDesactive")
     */
    public function compteDesactive()
    {

        return $this->render('login/desactive.html.twig');
    }

    /**
     * @Route("/ErreurOrganisation", name="ErreurOrganisation")
     */
    public function ErreurOrganisation()
    {

        return $this->render('login/paslieer.html.twig');
    }

    /**
     * @Route("/reset/{code}", name="resetcode")
     */
    public function resetcode($code)
    {
        $reset = false;
        $user = $this->em->getRepository(User::class)->checkCodeResetUser($code);
        $idUser = 0;
        $email = 'none';
        if (count($user) == 1) {
            $reset = true;
            $idUser = $user[0]['id'];
            $email = $user[0]['email'];
        }
        return $this->render('reset.html.twig', ['reset' => $reset, 'idUser' => $idUser, 'code' => $code, 'email' => $email]);
    }

}
