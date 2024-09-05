<?php

namespace App\Entity;

use App\Repository\CategorysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Annonces>
     */
    #[ORM\OneToMany(targetEntity: Annonces::class, mappedBy: 'categoryId')]
    private Collection $annonces;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Annonces>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonces $annonce): static
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces->add($annonce);
            $annonce->setCategoryId($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonces $annonce): static
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getCategoryId() === $this) {
                $annonce->setCategoryId(null);
            }
        }

        return $this;
    }
}
