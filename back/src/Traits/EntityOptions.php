<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;

trait EntityOptions
{

    #[ORM\Column(type:"datetime_immutable")]
    private ?\DateTimeImmutable $createdAt;

    #[ORM\Column(type:"datetime_immutable",nullable: true)]
    private ?\DateTimeImmutable $deletedAt;

    #[ORM\Column(type:"boolean")]
    private bool $actif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->createdAt = new \DateTimeImmutable("now");
        $this->actif = true;
    }

    public function changeEtat(): void
    {
        $this->actif = !($this->actif);
    }
}