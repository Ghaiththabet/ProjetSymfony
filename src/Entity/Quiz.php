<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $QuizTitle = null;

    #[ORM\Column(length: 50)]
    private ?string $QuizType = null;


    #[ORM\OneToOne(mappedBy: 'quiz', cascade: ['persist', 'remove'])]
    private ?Cours $cours = null;

    /**
     * @var Collection<int, Question>
     */
    #[ORM\OneToMany(targetEntity: Question::class, mappedBy: 'quiz')]
    private Collection $questions;

    #[ORM\OneToOne(inversedBy: 'quiz', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Resultat $resultat = null;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuizTitle(): ?string
    {
        return $this->QuizTitle;
    }

    public function setQuizTitle(string $QuizTitle): static
    {
        $this->QuizTitle = $QuizTitle;

        return $this;
    }

    public function getQuizType(): ?string
    {
        return $this->QuizType;
    }

    public function setQuizType(string $QuizType): static
    {
        $this->QuizType = $QuizType;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(Cours $cours): static
    {
        // set the owning side of the relation if necessary
        if ($cours->getQuiz() !== $this) {
            $cours->setQuiz($this);
        }

        $this->cours = $cours;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

        return $this;
    }

    public function getResultat(): ?Resultat
    {
        return $this->resultat;
    }

    public function setResultat(Resultat $resultat): static
    {
        $this->resultat = $resultat;

        return $this;
    }
}
