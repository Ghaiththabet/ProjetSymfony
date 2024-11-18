<?php

namespace App\Entity;

use App\Repository\FeedbackRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeedbackRepository::class)]
class Feedback
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    #[ORM\ManyToOne(inversedBy: 'feedbacks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etudiant $etudiants = null;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getEtudiants(): ?Etudiant
    {
        return $this->etudiants;
    }

    public function setEtudiants(?Etudiant $etudiants): static
    {
        $this->etudiants = $etudiants;

        return $this;
    }

    
}
