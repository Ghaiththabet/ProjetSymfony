<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $CoursTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CoursDesc = null;

    

    #[ORM\OneToOne(inversedBy: 'cours', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enseignant $enseignant = null;

    #[ORM\OneToOne(inversedBy: 'cours', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Quiz $quiz = null;

    /**
     * @var Collection<int, Etudiant>
     */
    #[ORM\ManyToMany(targetEntity: Etudiant::class, inversedBy: 'cours')]
    private Collection $etudiants;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoursTitle(): ?string
    {
        return $this->CoursTitle;
    }

    public function setCoursTitle(string $CoursTitle): static
    {
        $this->CoursTitle = $CoursTitle;

        return $this;
    }

    public function getCoursDesc(): ?string
    {
        return $this->CoursDesc;
    }

    public function setCoursDesc(?string $CoursDesc): static
    {
        $this->CoursDesc = $CoursDesc;

        return $this;
    }

    public function getEnseignant(): ?Enseignant
    {
        return $this->enseignant;
    }

    public function setEnseignant(Enseignant $enseignant): static
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(Quiz $quiz): static
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * @return Collection<int, Etudiant>
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): static
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants->add($etudiant);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): static
    {
        $this->etudiants->removeElement($etudiant);

        return $this;
    }
}
