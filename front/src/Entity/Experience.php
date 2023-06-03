<?php

namespace App\Entity;

use App\Repository\ExperienceRepository;
use App\Traits\EntityOptions;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:ExperienceRepository::class)]
class Experience
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\Column(type: "string", length: 100)]
    private ?string $titre;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $description;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $dateDebut;

    #[ORM\Column(type: "date", nullable: true)]
    private ?\DateTimeInterface $dateFin;

    #[ORM\ManyToOne(targetEntity: Profil::class, inversedBy:"experiences")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profil $profil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

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
