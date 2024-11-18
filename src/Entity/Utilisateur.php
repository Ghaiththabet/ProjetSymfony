<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "role", type: "string")]
#[ORM\DiscriminatorMap(["admin" => "Admin", "etudiant" => "Etudiant", "enseignant" => "Enseignant"])]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   

    #[ORM\Column(length: 50)]
    private ?string $Username = null;

    #[ORM\Column(length: 100)]
    private ?string $UserEmail = null;

    #[ORM\Column(length: 255)]
    private ?string $UserPwd = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evenement $evenments = null;

    #[ORM\Column(type: Types::JSON)]
    private array $roles = [];

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __construct()
    {
        // Par défaut, l'utilisateur n'a pas de rôle spécifique
        $this->roles = [];
    }
    

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): static
    {
        $this->Username = $Username;

        return $this;
    }

    public function getUserEmail(): ?string
    {
        return $this->UserEmail;
    }

    public function setUserEmail(string $UserEmail): static
    {
        $this->UserEmail = $UserEmail;

        return $this;
    }

    public function getUserPwd(): ?string
    {
        return $this->UserPwd;
    }

    public function setUserPwd(string $UserPwd): static
    {
        $this->UserPwd = $UserPwd;

        return $this;
    }

    public function getEvenments(): ?Evenement
    {
        return $this->evenments;
    }

    public function setEvenments(?Evenement $evenments): static
    {
        $this->evenments = $evenments;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }
}
