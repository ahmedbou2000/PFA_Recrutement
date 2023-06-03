<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Candidat;
use App\Entity\Domaine;
use App\Entity\Profil;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class AppFixtures extends Fixture
{
    private $paramBag,$em;
    public function __construct(ParameterBagInterface $parameterBag,EntityManagerInterface $em)
    {
        $this->paramBag = $parameterBag;
        $this->em = $em;
    }

    public function load(ObjectManager $manager): void
    {
        $parentDomaine = new Domaine();
        $parentDomaine->setNom('informatique');
        $manager->persist($parentDomaine);

        $subDomaine = new Domaine();
        $subDomaine->setNom('back end')
            ->setParentDomaine($parentDomaine);
        $manager->persist($subDomaine);

        $subDomaine->setNom('frond end')
            ->setParentDomaine($parentDomaine);
        $manager->persist($subDomaine);

        $admin = new Admin();
        $admin->setNom('abdelouahab')
            ->setPrenom('mohammed')
            ->setPassword('123')
            ->setEmail('m@g.c');
        $manager->persist($admin);

        $candidat = new Candidat();
        $candidat->setNom('bill')
            ->setAge(35)
            ->setGender('Homme')
            ->setPrenom('gates')
            ->setPassword('123')
            ->setEmail('bill@g.c');
        $manager->persist($candidat);

        $profil = new Profil();
        $profil->setAlert(false)
            ->setDomaine($parentDomaine)
            ->setCandidat($candidat)
            ->setDetails('detailsss bill 1')
            ->setExperience(5)
            ->setPrixParHeure(15);
        $manager->persist($profil);

        $profil2 = new Profil();
        $profil2->setAlert(false)
            ->setDomaine($subDomaine)
            ->setCandidat($candidat)
            ->setDetails('detailss bill 2')
            ->setExperience(3)
            ->setPrixParHeure(3500);
        $manager->persist($profil2);

        $candidat2 = new Candidat();
        $candidat2->setNom('elon')
            ->setPrenom('mask')
            ->setAge(62)
            ->setGender('Homme')
            ->setPassword('123')
            ->setEmail('elon@g.c');
        $manager->persist($candidat2);

        $profil2 = new Profil();
        $profil2->setAlert(false)
            ->setDomaine($parentDomaine)
            ->setCandidat($candidat2)
            ->setDetails('details elon')
            ->setExperience(3)
            ->setPrixParHeure(3500);
        $manager->persist($profil2);

        $manager->flush();
    }
}
