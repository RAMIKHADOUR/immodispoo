<?php

namespace App\Entity;

use App\Repository\ReferencesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReferencesRepository::class)]
#[ORM\Table(name: '`references`')]
class References
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code_annonce = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeAnnonce(): ?string
    {
        return $this->code_annonce;
    }

    public function setCodeAnnonce(string $code_annonce): static
    {
        $this->code_annonce = $code_annonce;

        return $this;
    }
}
