<?php

namespace App\Entity;

use App\Repository\CandidatFavouriteOffreRepository;
use App\Traits\EntityOptions;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:CandidatFavouriteOffreRepository::class)]
class CandidatFavouriteOffre
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity:Offre::class, inversedBy:"candidatFavouriteOffres")]
    #[ORM\JoinColumn(nullable:false)]
    private ?Offre $offre;

    #[ORM\ManyToOne(targetEntity:Candidat::class, inversedBy:"candidatFavouriteOffres")]
    #[ORM\JoinColumn(nullable:false)]
    private ?Candidat $candidat;

    public function getId(): ?int
    {
        return $this->id;
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
