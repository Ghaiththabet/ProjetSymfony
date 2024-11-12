<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $questionEnonce = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $questionChoix = [];

    #[ORM\Column(length: 50)]
    private ?string $reponseCorrecte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionEnonce(): ?string
    {
        return $this->questionEnonce;
    }

    public function setQuestionEnonce(string $questionEnonce): static
    {
        $this->questionEnonce = $questionEnonce;

        return $this;
    }

    public function getQuestionChoix(): array
    {
        return $this->questionChoix;
    }

    public function setQuestionChoix(array $questionChoix): static
    {
        $this->questionChoix = $questionChoix;

        return $this;
    }

    public function getReponseCorrecte(): ?string
    {
        return $this->reponseCorrecte;
    }

    public function setReponseCorrecte(string $reponseCorrecte): static
    {
        $this->reponseCorrecte = $reponseCorrecte;

        return $this;
    }
}
