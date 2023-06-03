<?php

namespace App\Entity;

use App\Repository\TypeContratRepository;
use App\Traits\EntityOptions;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:TypeContratRepository::class)]
class TypeContrat
{
    use EntityOptions;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id;

    #[ORM\Column(type:"string", length: 255)]
    private ?string $nom;

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
}
