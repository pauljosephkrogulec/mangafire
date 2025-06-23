<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\UuidV6;

#[ORM\Entity]
#[Table(name: 'users')]
#[ApiResource(
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:write']],
    operations: [
        new GetCollection(security: "is_granted('ROLE_USER')",),
        new Get(security: "is_granted('ROLE_ADMIN') or object == user",),
        new Put(security: "is_granted('ROLE_ADMIN') or object == user",),
        new Delete(security: "is_granted('ROLE_ADMIN') or object == user",),
    ],
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Groups(['user:read'])]
    private ?UuidV6 $id = null;

    #[ORM\Column(unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Groups(['user:read', 'user:write'])]
    private ?string $email = null;

    #[ORM\Column(type: 'json')]
    #[Groups(['user:read'])]
    private array $roles = ['ROLE_USER'];

    #[ORM\Column]
    #[Groups(['user:write'])]
    #[Assert\NotBlank(groups: ['user:write'])]
    private ?string $password = null;

    #[ORM\Column(unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Groups(['user:read', 'user:write'])]
    private ?string $username = null;

    // Getters and setters

    public function getId(): ?UuidV6
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
    }
    public function getUserIdentifier(): string
    {
        return $this->username ?? '';
    }
}
