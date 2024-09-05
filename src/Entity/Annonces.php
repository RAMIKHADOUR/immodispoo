<?php

namespace App\Entity;

use App\Repository\AnnoncesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnoncesRepository::class)]
class Annonces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $title = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'annonceId')]
    private ?Users $users = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Cordonnes $cordonneId = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Adresses $adresseId = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Descriptions $descriptionId = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?Categorys $categoryId = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?References $referenceId = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?TypesAnnonce $typeId = null;

    /**
     * @var Collection<int, Medias>
     */
    #[ORM\OneToMany(targetEntity: Medias::class, mappedBy: 'annonces')]
    private Collection $mediaId;

    public function __construct()
    {
        $this->mediaId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function getCordonneId(): ?Cordonnes
    {
        return $this->cordonneId;
    }

    public function setCordonneId(?Cordonnes $cordonneId): static
    {
        $this->cordonneId = $cordonneId;

        return $this;
    }

    public function getAdresseId(): ?Adresses
    {
        return $this->adresseId;
    }

    public function setAdresseId(?Adresses $adresseId): static
    {
        $this->adresseId = $adresseId;

        return $this;
    }

    public function getDescriptionId(): ?Descriptions
    {
        return $this->descriptionId;
    }

    public function setDescriptionId(?Descriptions $descriptionId): static
    {
        $this->descriptionId = $descriptionId;

        return $this;
    }

    public function getCategoryId(): ?Categorys
    {
        return $this->categoryId;
    }

    public function setCategoryId(?Categorys $categoryId): static
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function getReferenceId(): ?References
    {
        return $this->referenceId;
    }

    public function setReferenceId(?References $referenceId): static
    {
        $this->referenceId = $referenceId;

        return $this;
    }

    public function getTypeId(): ?TypesAnnonce
    {
        return $this->typeId;
    }

    public function setTypeId(?TypesAnnonce $typeId): static
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * @return Collection<int, Medias>
     */
    public function getMediaId(): Collection
    {
        return $this->mediaId;
    }

    public function addMediaId(Medias $mediaId): static
    {
        if (!$this->mediaId->contains($mediaId)) {
            $this->mediaId->add($mediaId);
            $mediaId->setAnnonces($this);
        }

        return $this;
    }

    public function removeMediaId(Medias $mediaId): static
    {
        if ($this->mediaId->removeElement($mediaId)) {
            // set the owning side to null (unless already changed)
            if ($mediaId->getAnnonces() === $this) {
                $mediaId->setAnnonces(null);
            }
        }

        return $this;
    }
}
