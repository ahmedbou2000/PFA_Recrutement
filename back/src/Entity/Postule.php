<?php

namespace App\Entity;

use App\Repository\PostuleRepository;
use App\Traits\EntityOptions;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:PostuleRepository::class)]
class Postule
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $date;

    #[ORM\ManyToOne(targetEntity: Profil::class, inversedBy: "postules")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profil $profil;

    #[ORM\ManyToOne(targetEntity: Offre::class, inversedBy: "postules")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offre $offre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getOffre(): ?Offre
    {
        return $this->offre;
    }

    public function setOffre(?Offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }
}
