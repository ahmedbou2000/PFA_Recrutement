<?php

namespace App\Entity;

use App\Repository\RecruteurFavouriteProfilRepository;
use App\Traits\EntityOptions;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:RecruteurFavouriteProfilRepository::class)]
class RecruteurFavouriteProfil
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Recruteur::class, inversedBy: "recruteurFavouriteProfils")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recruteur $recruteur;

    #[ORM\ManyToOne(targetEntity: Profil::class, inversedBy: "recruteurFavouriteProfils")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profil $profil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecruteur(): ?Recruteur
    {
        return $this->recruteur;
    }

    public function setRecruteur(?Recruteur $recruteur): self
    {
        $this->recruteur = $recruteur;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }
}
