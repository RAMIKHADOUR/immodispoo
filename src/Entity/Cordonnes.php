<?php

namespace App\Entity;

use App\Repository\CordonnesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CordonnesRepository::class)]
class Cordonnes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $civilite = null;

    #[ORM\Column(length: 100)]
    private ?string $prenomnom = null;

    #[ORM\Column(length: 255)]
    private ?string $e_mail = null;

    #[ORM\Column(length: 255)]
    private ?string $tele_mobile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tele_fixe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): static
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getPrenomnom(): ?string
    {
        return $this->prenomnom;
    }

    public function setPrenomnom(string $prenomnom): static
    {
        $this->prenomnom = $prenomnom;

        return $this;
    }

    public function getEMail(): ?string
    {
        return $this->e_mail;
    }

    public function setEMail(string $e_mail): static
    {
        $this->e_mail = $e_mail;

        return $this;
    }

    public function getTeleMobile(): ?string
    {
        return $this->tele_mobile;
    }

    public function setTeleMobile(string $tele_mobile): static
    {
        $this->tele_mobile = $tele_mobile;

        return $this;
    }

    public function getTeleFixe(): ?string
    {
        return $this->tele_fixe;
    }

    public function setTeleFixe(?string $tele_fixe): static
    {
        $this->tele_fixe = $tele_fixe;

        return $this;
    }
}
