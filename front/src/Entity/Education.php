<?php

namespace App\Entity;

use App\Repository\EducationRepository;
use App\Traits\EntityOptions;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:EducationRepository::class)]
class Education
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\Column(type:"string", length: 100)]
    private ?string $titre;

    #[ORM\Column(type:"string", length: 255, nullable: true)]
    private ?string $description;

    #[ORM\Column(type:"date")]
    private ?\DateTimeInterface $dateDebut;

    #[ORM\Column(type:"date")]
    private ?\DateTimeInterface $dateFin;

    #[ORM\ManyToOne(targetEntity:Candidat::class, inversedBy: "education")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Candidat $candidat;

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

    public function setDescription(?string $description): self
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

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getCandidat(): ?Candidat
    {
        return $this->candidat;
    }

    public function setCandidat(?Candidat $candidat): self
    {
        $this->candidat = $candidat;

        return $this;
    }
}
