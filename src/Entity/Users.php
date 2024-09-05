<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private bool $isVerified = false;

    /**
     * @var Collection<int, Annonces>
     */
    #[ORM\OneToMany(targetEntity: Annonces::class, mappedBy: 'users')]
    private Collection $annonceId;

    /**
     * @var Collection<int, Messages>
     */
    #[ORM\OneToMany(targetEntity: Messages::class, mappedBy: 'users')]
    private Collection $messageId;

    /**
     * @var Collection<int, Contacts>
     */
    #[ORM\OneToMany(targetEntity: Contacts::class, mappedBy: 'users')]
    private Collection $contactId;

    public function __construct()
    {
        $this->annonceId = new ArrayCollection();
        $this->messageId = new ArrayCollection();
        $this->contactId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Annonces>
     */
    public function getAnnonceId(): Collection
    {
        return $this->annonceId;
    }

    public function addAnnonceId(Annonces $annonceId): static
    {
        if (!$this->annonceId->contains($annonceId)) {
            $this->annonceId->add($annonceId);
            $annonceId->setUsers($this);
        }

        return $this;
    }

    public function removeAnnonceId(Annonces $annonceId): static
    {
        if ($this->annonceId->removeElement($annonceId)) {
            // set the owning side to null (unless already changed)
            if ($annonceId->getUsers() === $this) {
                $annonceId->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getMessageId(): Collection
    {
        return $this->messageId;
    }

    public function addMessageId(Messages $messageId): static
    {
        if (!$this->messageId->contains($messageId)) {
            $this->messageId->add($messageId);
            $messageId->setUsers($this);
        }

        return $this;
    }

    public function removeMessageId(Messages $messageId): static
    {
        if ($this->messageId->removeElement($messageId)) {
            // set the owning side to null (unless already changed)
            if ($messageId->getUsers() === $this) {
                $messageId->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contacts>
     */
    public function getContactId(): Collection
    {
        return $this->contactId;
    }

    public function addContactId(Contacts $contactId): static
    {
        if (!$this->contactId->contains($contactId)) {
            $this->contactId->add($contactId);
            $contactId->setUsers($this);
        }

        return $this;
    }

    public function removeContactId(Contacts $contactId): static
    {
        if ($this->contactId->removeElement($contactId)) {
            // set the owning side to null (unless already changed)
            if ($contactId->getUsers() === $this) {
                $contactId->setUsers(null);
            }
        }

        return $this;
    }
}
