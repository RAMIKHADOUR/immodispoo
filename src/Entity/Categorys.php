<?php

namespace App\Entity;

use App\Repository\CategorysRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorysRepository::class)]
class Categorys
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $categorie_bien = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorieBien(): ?string
    {
        return $this->categorie_bien;
    }

    public function setCategorieBien(string $categorie_bien): static
    {
        $this->categorie_bien = $categorie_bien;

        return $this;
    }
}
