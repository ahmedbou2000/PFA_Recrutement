<?php

namespace App\EventSubscriber;

use App\Entity\Admin;
use App\Entity\Candidat;
use App\Entity\Recruteur;
use App\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class CryptagePasswordSubscriber implements EventSubscriber
{
    private ParameterBagInterface $parameterBag;
    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(UserPasswordHasherInterface  $passwordEncoder,
                                ParameterBagInterface  $parameterBag)
    {
        $this->passwordEncoder=$passwordEncoder;
        $this->parameterBag=$parameterBag;
    }
    public  function getSubscribedEvents(): array
    {
        return array(
            Events::prePersist,
            Events::preUpdate,
        );
    }
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $entity->setActif(true);

        $this->encryptPassword($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->encryptPassword($args);
    }

    private function encryptPassword(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        $role = '';
        $entity->setCreatedAt(new \DateTimeImmutable("now"));

        if ($entity instanceof User) {
            if ($entity instanceof Candidat)
                $role = 'role_candidat';

            else if ($entity instanceof Recruteur)
                $role = 'role_recruteur';

            else if ($entity instanceof Admin)
                $role = 'role_admin';

            $entity->setRoles([$this->parameterBag->get($role)]);
            $entity->setPassword($this->passwordEncoder->hashPassword($entity,$entity->getPassword()));
        }
    }
}
