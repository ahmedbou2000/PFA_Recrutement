<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use App\Traits\EntityOptions;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:ProfilRepository::class)]
class Profil
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id;

    #[ORM\Column(type: "integer")]
    private ?int $experience;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $details;

    #[ORM\Column(type: "float")]
    private ?float $prixParHeure;

    #[ORM\Column(type: "boolean")]
    private bool $alert;

    #[ORM\OneToMany(mappedBy: "profil", targetEntity: Postule::class)]
    private Collection $postules;

    #[ORM\OneToMany(mappedBy: "profil", targetEntity: RecruteurFavouriteProfil::class)]
    private Collection $recruteurFavouriteProfils;

    #[ORM\OneToMany(mappedBy: "profil", targetEntity: Experience::class)]
    private Collection $experiences;

    #[ORM\OneToMany(mappedBy: "profil", targetEntity: Avis::class)]
    private Collection $avis;

    #[ORM\ManyToOne(inversedBy: 'profils')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Candidat $candidat = null;

    #[ORM\ManyToOne(inversedBy: 'profils')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Domaine $domaine = null;

    public function __construct()
    {
        $this->postules = new ArrayCollection();
        $this->recruteurFavouriteProfils = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getPrixParHeure(): ?float
    {
        return $this->prixParHeure;
    }

    public function setPrixParHeure(float $prixParHeure): self
    {
        $this->prixParHeure = $prixParHeure;

        return $this;
    }

    public function isAlert(): ?bool
    {
        return $this->alert;
    }

    public function setAlert(bool $alert): self
    {
        $this->alert = $alert;

        return $this;
    }

    /**
     * @return Collection<int, Postule>
     */
    public function getPostules(): Collection
    {
        return $this->postules;
    }

    public function addPostule(Postule $postule): self
    {
        if (!$this->postules->contains($postule)) {
            $this->postules[] = $postule;
            $postule->setProfil($this);
        }

        return $this;
    }

    public function removePostule(Postule $postule): self
    {
        if ($this->postules->removeElement($postule)) {
            // set the owning side to null (unless already changed)
            if ($postule->getProfil() === $this) {
                $postule->setProfil(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RecruteurFavouriteProfil>
     */
    public function getRecruteurFavouriteProfils(): Collection
    {
        return $this->recruteurFavouriteProfils;
    }

    public function addRecruteurFavouriteProfil(RecruteurFavouriteProfil $recruteurFavouriteProfil): self
    {
        if (!$this->recruteurFavouriteProfils->contains($recruteurFavouriteProfil)) {
            $this->recruteurFavouriteProfils[] = $recruteurFavouriteProfil;
            $recruteurFavouriteProfil->setProfil($this);
        }

        return $this;
    }

    public function removeRecruteurFavouriteProfil(RecruteurFavouriteProfil $recruteurFavouriteProfil): self
    {
        if ($this->recruteurFavouriteProfils->removeElement($recruteurFavouriteProfil)) {
            // set the owning side to null (unless already changed)
            if ($recruteurFavouriteProfil->getProfil() === $this) {
                $recruteurFavouriteProfil->setProfil(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Experience>
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setProfil($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getProfil() === $this) {
                $experience->setProfil(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setProfil($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getProfil() === $this) {
                $avi->setProfil(null);
            }
        }

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

    /**
     * @return Collection<int, self>
     */
    public function getProfils(): Collection
    {
        return $this->profils;
    }

    public function addProfil(self $profil): self
    {
        if (!$this->profils->contains($profil)) {
            $this->profils->add($profil);
        }

        return $this;
    }

    public function getDomaine(): ?Domaine
    {
        return $this->domaine;
    }

    public function setDomaine(?Domaine $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }
}
