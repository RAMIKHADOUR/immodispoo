<?php

namespace App\Entity;

use App\Repository\TypesAnnonceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypesAnnonceRepository::class)]
class TypesAnnonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $type_annonces = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeAnnonces(): ?string
    {
        return $this->type_annonces;
    }

    public function setTypeAnnonces(string $type_annonces): static
    {
        $this->type_annonces = $type_annonces;

        return $this;
    }
}
