<?php

namespace App\Entity;

use App\Repository\DomaineRepository;
use App\Traits\EntityOptions;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:DomaineRepository::class)]
class Domaine
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\Column(type: "string", length: 50)]
    private ?string $nom;

    #[ORM\ManyToOne(targetEntity: Domaine::class, inversedBy: "domaines")]
    private ?Domaine $parentDomaine;

    #[ORM\OneToMany(mappedBy: "parentDomaine", targetEntity: Domaine::class)]
    private Collection $domaines;

    #[ORM\OneToMany(mappedBy: "domaine", targetEntity: Offre::class)]
    private Collection $offres;

    #[ORM\OneToMany(mappedBy: 'domaine', targetEntity: Profil::class)]
    private Collection $profils;

    public function __construct()
    {
        $this->domaines = new ArrayCollection();
        $this->offres = new ArrayCollection();
        $this->profils = new ArrayCollection();
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

    public function getParentDomaine(): ?self
    {
        return $this->parentDomaine;
    }

    public function setParentDomaine(?self $parentDomaine): self
    {
        $this->parentDomaine = $parentDomaine;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getDomaines(): Collection
    {
        return $this->domaines;
    }

    public function addDomaine(self $domaine): self
    {
        if (!$this->domaines->contains($domaine)) {
            $this->domaines[] = $domaine;
            $domaine->setParentDomaine($this);
        }

        return $this;
    }

    public function removeDomaine(self $domaine): self
    {
        if ($this->domaines->removeElement($domaine)) {
            // set the owning side to null (unless already changed)
            if ($domaine->getParentDomaine() === $this) {
                $domaine->setParentDomaine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Offre>
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->setDomaine($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offres->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getDomaine() === $this) {
                $offre->setDomaine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Profil>
     */
    public function getProfils(): Collection
    {
        return $this->profils;
    }

    public function addProfil(Profil $profil): self
    {
        if (!$this->profils->contains($profil)) {
            $this->profils->add($profil);
            $profil->setDomaine($this);
        }

        return $this;
    }

    public function removeProfil(Profil $profil): self
    {
        if ($this->profils->removeElement($profil)) {
            // set the owning side to null (unless already changed)
            if ($profil->getDomaine() === $this) {
                $profil->setDomaine(null);
            }
        }

        return $this;
    }
}
