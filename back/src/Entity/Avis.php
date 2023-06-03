<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use App\Traits\EntityOptions;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:AvisRepository::class)]
class Avis
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\Column(type:"string", length:250,nullable: true)]
    private ?string $message;

    #[ORM\Column(type:"integer")]
    private ?int $star;

    #[ORM\ManyToOne(targetEntity:Profil::class, inversedBy: "avis")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profil $profil;

    #[ORM\ManyToOne(targetEntity:Recruteur::class, inversedBy: "avis")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recruteur $recruteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getStar(): ?int
    {
        return $this->star;
    }

    public function setStar(int $star): self
    {
        $this->star = $star;

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

    public function getRecruteur(): ?Recruteur
    {
        return $this->recruteur;
    }

    public function setRecruteur(?Recruteur $recruteur): self
    {
        $this->recruteur = $recruteur;

        return $this;
    }
}
