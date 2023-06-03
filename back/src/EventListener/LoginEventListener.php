<?php
namespace App\EventListener;

use App\Entity\Admin;
use App\Entity\Candidat;
use App\Entity\Recruteur;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginEventListener extends AbstractController
{
    public function onLogin(InteractiveLoginEvent $event)
    {
        /*$user = $event->getAuthenticationToken()->getUser();

        $route = 'home';
        if ($user instanceof Candidat)
            $route = 'home_candidat';

        else if ($user instanceof Recruteur)
            $route = 'home_recruteur';

        else if ($user instanceof Admin)
            $route = 'home_admin';

        return $this->redirectToRoute($route);*/
    }
}