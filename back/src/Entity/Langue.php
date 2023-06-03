<?php

namespace App\Entity;

use App\Repository\LangueRepository;
use App\Traits\EntityOptions;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:LangueRepository::class)]
class Langue
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\Column(type: "string", length: 50)]
    private ?string $nom;

    #[ORM\OneToMany(mappedBy: "langue", targetEntity: LangueReq::class)]
    private Collection $langueReqs;

    public function __construct()
    {
        $this->langueReqs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, LangueReq>
     */
    public function getLangueReqs(): Collection
    {
        return $this->langueReqs;
    }

    public function addLangueReq(LangueReq $langueReq): self
    {
        if (!$this->langueReqs->contains($langueReq)) {
            $this->langueReqs[] = $langueReq;
            $langueReq->setLangue($this);
        }

        return $this;
    }

    public function removeLangueReq(LangueReq $langueReq): self
    {
        if ($this->langueReqs->removeElement($langueReq)) {
            // set the owning side to null (unless already changed)
            if ($langueReq->getLangue() === $this) {
                $langueReq->setLangue(null);
            }
        }

        return $this;
    }
}
