<?php

namespace App\Entity;

use App\Repository\LangueReqRepository;
use App\Traits\EntityOptions;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:LangueReqRepository::class)]
class LangueReq
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\Column(type: "string", length: 100)]
    private ?string $niveau;

    #[ORM\ManyToOne(targetEntity: Langue::class, inversedBy:"langueReqs")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Langue $langue;

    #[ORM\ManyToOne(targetEntity: Offre::class, inversedBy:"langueReqs")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offre $offre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getLangue(): ?Langue
    {
        return $this->langue;
    }

    public function setLangue(?Langue $langue): self
    {
        $this->langue = $langue;

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
