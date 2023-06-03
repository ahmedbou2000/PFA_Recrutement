<?php

namespace App\Entity;

use App\Repository\RecruteurRepository;
use App\Traits\EntityOptions;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:RecruteurRepository::class)]
class Recruteur extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private int $id;

    #[ORM\OneToMany(mappedBy: "recruteur", targetEntity: Message::class)]
    private Collection $messages;

    #[ORM\OneToMany(mappedBy: "recruteur", targetEntity: Notification::class)]
    private Collection $notifications;

    #[ORM\OneToMany(mappedBy: "recruteur", targetEntity: RecruteurFavouriteProfil::class)]
    private Collection $recruteurFavouriteProfils;

    #[ORM\OneToMany(mappedBy: "recruteur", targetEntity: Avis::class)]
    private Collection $avis;

    #[ORM\Column(type: "string", length: 100)]
    private ?string $nomEntreprise;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->recruteurFavouriteProfils = new ArrayCollection();
        $this->avis = new ArrayCollection();
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
            $message->setRecruteur($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getRecruteur() === $this) {
                $message->setRecruteur(null);
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
            $notification->setRecruteur($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getRecruteur() === $this) {
                $notification->setRecruteur(null);
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
            $recruteurFavouriteProfil->setRecruteur($this);
        }

        return $this;
    }

    public function removeRecruteurFavouriteProfil(RecruteurFavouriteProfil $recruteurFavouriteProfil): self
    {
        if ($this->recruteurFavouriteProfils->removeElement($recruteurFavouriteProfil)) {
            // set the owning side to null (unless already changed)
            if ($recruteurFavouriteProfil->getRecruteur() === $this) {
                $recruteurFavouriteProfil->setRecruteur(null);
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
            $avi->setRecruteur($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getRecruteur() === $this) {
                $avi->setRecruteur(null);
            }
        }

        return $this;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): self
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }
}
