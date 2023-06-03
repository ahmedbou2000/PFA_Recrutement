<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use App\Traits\EntityOptions;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:MessageRepository::class)]
class Message
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\Column(type:"string", length: 255)]
    private ?string $content;

    #[ORM\ManyToOne(targetEntity: Recruteur::class, inversedBy:"messages")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recruteur $recruteur;

    #[ORM\ManyToOne(targetEntity: Candidat::class, inversedBy:"messages")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Candidat $candidat;

    #[ORM\Column(type: "string", length: 10)]
    private ?string $sender;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getSender(): ?string
    {
        return $this->sender;
    }

    public function setSender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
