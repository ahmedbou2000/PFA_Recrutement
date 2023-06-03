<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use App\Traits\EntityOptions;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass:OffreRepository::class)]
class Offre
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\Column(type: "string", length: 50)]
    private ?string $titre;

    #[ORM\Column(type: "float")]
    private ?float $remunerationMin;

    #[ORM\Column(type: "float", nullable: true)]
    private ?float $remunerationMax;

    #[ORM\Column(type: "text")]
    private ?string $details;

    #[ORM\Column(type: "date", nullable: true)]
    private ?\DateTimeInterface $dateFin;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $experience;

    #[ORM\Column(type: "json", nullable: true)]
    private array $tags = [];

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $duree;

    #[ORM\ManyToOne(targetEntity: Disponibilite::class, inversedBy:"offres")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Disponibilite $disponibilite;

    #[ORM\OneToMany(mappedBy: "offre", targetEntity: LangueReq::class)]
    private Collection $langueReqs;

    #[ORM\OneToMany(mappedBy: "offre", targetEntity: Postule::class)]
    private Collection $postules;

    #[ORM\OneToMany(mappedBy: "offre", targetEntity: CandidatFavouriteOffre::class)]
    private Collection $candidatFavouriteOffres;

    #[ORM\ManyToOne(targetEntity: Ville::class, inversedBy: "offres")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ville $ville;

    #[ORM\ManyToOne(targetEntity: Domaine::class, inversedBy: "offres")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Domaine $domaine;

    #[ORM\Column(type: "boolean")]
    private bool $accepted;

    #[ORM\ManyToOne(targetEntity: Admin::class, inversedBy: "offres")]
    private ?Admin $acceptedBy;

    public function __construct()
    {
        $this->langueReqs = new ArrayCollection();
        $this->postules = new ArrayCollection();
        $this->candidatFavouriteOffres = new ArrayCollection();
    }

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

    public function getRemunerationMin(): ?float
    {
        return $this->remunerationMin;
    }

    public function setRemunerationMin(float $remunerationMin): self
    {
        $this->remunerationMin = $remunerationMin;

        return $this;
    }

    public function getRemunerationMax(): ?float
    {
        return $this->remunerationMax;
    }

    public function setRemunerationMax(?float $remunerationMax): self
    {
        $this->remunerationMax = $remunerationMax;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

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

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(?int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function setTags(?array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDisponibilite(): ?Disponibilite
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(?Disponibilite $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

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
            $langueReq->setOffre($this);
        }

        return $this;
    }

    public function removeLangueReq(LangueReq $langueReq): self
    {
        if ($this->langueReqs->removeElement($langueReq)) {
            // set the owning side to null (unless already changed)
            if ($langueReq->getOffre() === $this) {
                $langueReq->setOffre(null);
            }
        }

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
            $postule->setOffre($this);
        }

        return $this;
    }

    public function removePostule(Postule $postule): self
    {
        if ($this->postules->removeElement($postule)) {
            // set the owning side to null (unless already changed)
            if ($postule->getOffre() === $this) {
                $postule->setOffre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CandidatFavouriteOffre>
     */
    public function getCandidatFavouriteOffres(): Collection
    {
        return $this->candidatFavouriteOffres;
    }

    public function addCandidatFavouriteOffre(CandidatFavouriteOffre $candidatFavouriteOffre): self
    {
        if (!$this->candidatFavouriteOffres->contains($candidatFavouriteOffre)) {
            $this->candidatFavouriteOffres[] = $candidatFavouriteOffre;
            $candidatFavouriteOffre->setOffre($this);
        }

        return $this;
    }

    public function removeCandidatFavouriteOffre(CandidatFavouriteOffre $candidatFavouriteOffre): self
    {
        if ($this->candidatFavouriteOffres->removeElement($candidatFavouriteOffre)) {
            // set the owning side to null (unless already changed)
            if ($candidatFavouriteOffre->getOffre() === $this) {
                $candidatFavouriteOffre->setOffre(null);
            }
        }

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

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

    public function isAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    public function getAcceptedBy(): ?Admin
    {
        return $this->acceptedBy;
    }

    public function setAcceptedBy(?Admin $acceptedBy): self
    {
        $this->acceptedBy = $acceptedBy;

        return $this;
    }
}
