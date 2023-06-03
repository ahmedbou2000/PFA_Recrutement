<?php

namespace App\Entity;

use App\Repository\CandidatRepository;
use App\Traits\EntityOptions;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass:CandidatRepository::class)]
class Candidat extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\OneToMany(mappedBy: "candidat", targetEntity: Education::class)]
    private Collection $education;

    #[ORM\OneToMany(mappedBy: "candidat", targetEntity: Message::class)]
    private Collection $messages;

    #[ORM\OneToMany(mappedBy: "candidat", targetEntity: Notification::class)]
    private Collection $notifications;

    #[ORM\OneToMany(mappedBy: "candidat", targetEntity: CandidatFavouriteOffre::class)]
    private Collection $candidatFavouriteOffres;

    #[ORM\OneToMany(mappedBy: 'candidat', targetEntity: Profil::class)]
    private Collection $profils;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 10)]
    private ?string $gender = null;

    public function __construct()
    {
        $this->education = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->candidatFavouriteOffres = new ArrayCollection();
        $this->profils = new ArrayCollection();
    }

    /**
     * @return Collection<int, Education>
     */
    public function getEducation(): Collection
    {
        return $this->education;
    }

    public function addEducation(Education $education): self
    {
        if (!$this->education->contains($education)) {
            $this->education[] = $education;
            $education->setCandidat($this);
        }

        return $this;
    }

    public function removeEducation(Education $education): self
    {
        if ($this->education->removeElement($education)) {
            // set the owning side to null (unless already changed)
            if ($education->getCandidat() === $this) {
                $education->setCandidat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setCandidat($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getCandidat() === $this) {
                $message->setCandidat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setCandidat($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getCandidat() === $this) {
                $notification->setCandidat(null);
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
            $candidatFavouriteOffre->setCandidat($this);
        }

        return $this;
    }

    public function removeCandidatFavouriteOffre(CandidatFavouriteOffre $candidatFavouriteOffre): self
    {
        if ($this->candidatFavouriteOffres->removeElement($candidatFavouriteOffre)) {
            // set the owning side to null (unless already changed)
            if ($candidatFavouriteOffre->getCandidat() === $this) {
                $candidatFavouriteOffre->setCandidat(null);
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
            $profil->setCandidat($this);
        }

        return $this;
    }

    public function removeProfil(Profil $profil): self
    {
        if ($this->profils->removeElement($profil)) {
            // set the owning side to null (unless already changed)
            if ($profil->getCandidat() === $this) {
                $profil->setCandidat(null);
            }
        }

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }
}
