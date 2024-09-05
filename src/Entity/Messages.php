<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $mail_envoy = null;

    #[ORM\Column(length: 255)]
    private ?string $mail_recu = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'messageId')]
    private ?Users $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMailEnvoy(): ?string
    {
        return $this->mail_envoy;
    }

    public function setMailEnvoy(string $mail_envoy): static
    {
        $this->mail_envoy = $mail_envoy;

        return $this;
    }

    public function getMailRecu(): ?string
    {
        return $this->mail_recu;
    }

    public function setMailRecu(string $mail_recu): static
    {
        $this->mail_recu = $mail_recu;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

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

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }
}
