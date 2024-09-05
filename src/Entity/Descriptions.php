<?php

namespace App\Entity;

use App\Repository\DescriptionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DescriptionsRepository::class)]
class Descriptions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $surface = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?int $chambres = null;

    #[ORM\Column]
    private ?int $salle_bain = null;

    #[ORM\Column]
    private ?int $etages = null;

    #[ORM\Column]
    private ?int $nomber_etages = null;

    #[ORM\Column(nullable: true)]
    private ?bool $internet = null;

    #[ORM\Column(nullable: true)]
    private ?bool $garage = null;

    #[ORM\Column(nullable: true)]
    private ?bool $piscine = null;

    #[ORM\Column(nullable: true)]
    private ?bool $camera = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): static
    {
        $this->surface = $surface;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getChambres(): ?int
    {
        return $this->chambres;
    }

    public function setChambres(int $chambres): static
    {
        $this->chambres = $chambres;

        return $this;
    }

    public function getSalleBain(): ?int
    {
        return $this->salle_bain;
    }

    public function setSalleBain(int $salle_bain): static
    {
        $this->salle_bain = $salle_bain;

        return $this;
    }

    public function getEtages(): ?int
    {
        return $this->etages;
    }

    public function setEtages(int $etages): static
    {
        $this->etages = $etages;

        return $this;
    }

    public function getNomberEtages(): ?int
    {
        return $this->nomber_etages;
    }

    public function setNomberEtages(int $nomber_etages): static
    {
        $this->nomber_etages = $nomber_etages;

        return $this;
    }

    public function isInternet(): ?bool
    {
        return $this->internet;
    }

    public function setInternet(?bool $internet): static
    {
        $this->internet = $internet;

        return $this;
    }

    public function isGarage(): ?bool
    {
        return $this->garage;
    }

    public function setGarage(?bool $garage): static
    {
        $this->garage = $garage;

        return $this;
    }

    public function isPiscine(): ?bool
    {
        return $this->piscine;
    }

    public function setPiscine(?bool $piscine): static
    {
        $this->piscine = $piscine;

        return $this;
    }

    public function isCamera(): ?bool
    {
        return $this->camera;
    }

    public function setCamera(?bool $camera): static
    {
        $this->camera = $camera;

        return $this;
    }
}
