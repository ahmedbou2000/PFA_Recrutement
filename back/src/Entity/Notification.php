<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use App\Traits\EntityOptions;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:NotificationRepository::class)]
class Notification
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\Column(type: "string", length: 100)]
    private ?string $titre;

    #[ORM\Column(type: "string", length: 100, nullable: true)]
    private ?string $description;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $link;

    #[ORM\ManyToOne(targetEntity: Recruteur::class, inversedBy:"notifications")]
    private ?Recruteur $recruteur;

    #[ORM\ManyToOne(targetEntity: Candidat::class, inversedBy:"notifications")]
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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

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
