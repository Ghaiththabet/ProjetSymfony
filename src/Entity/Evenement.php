<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $EventName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $EventDate = null;

    #[ORM\Column(length: 50)]
    private ?string $EventPlace = null;

    #[ORM\Column(length: 255)]
    private ?string $EventDesc = null;

    /**
     * @var Collection<int, Hackathon>
     */
    #[ORM\OneToMany(targetEntity: Hackathon::class, mappedBy: 'evenement')]
    private Collection $hackathons;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\OneToMany(targetEntity: Utilisateur::class, mappedBy: 'evenments')]
    private Collection $utilisateurs;

    public function __construct()
    {
        $this->hackathons = new ArrayCollection();
        $this->utilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventName(): ?string
    {
        return $this->EventName;
    }

    public function setEventName(string $EventName): static
    {
        $this->EventName = $EventName;

        return $this;
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->EventDate;
    }

    public function setEventDate(\DateTimeInterface $EventDate): static
    {
        $this->EventDate = $EventDate;

        return $this;
    }

    public function getEventPlace(): ?string
    {
        return $this->EventPlace;
    }

    public function setEventPlace(string $EventPlace): static
    {
        $this->EventPlace = $EventPlace;

        return $this;
    }

    public function getEventDesc(): ?string
    {
        return $this->EventDesc;
    }

    public function setEventDesc(string $EventDesc): static
    {
        $this->EventDesc = $EventDesc;

        return $this;
    }

    /**
     * @return Collection<int, Hackathon>
     */
    public function getHackathons(): Collection
    {
        return $this->hackathons;
    }

    public function addHackathon(Hackathon $hackathon): static
    {
        if (!$this->hackathons->contains($hackathon)) {
            $this->hackathons->add($hackathon);
            $hackathon->setEvenement($this);
        }

        return $this;
    }

    public function removeHackathon(Hackathon $hackathon): static
    {
        if ($this->hackathons->removeElement($hackathon)) {
            // set the owning side to null (unless already changed)
            if ($hackathon->getEvenement() === $this) {
                $hackathon->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->setEvenments($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getEvenments() === $this) {
                $utilisateur->setEvenments(null);
            }
        }

        return $this;
    }
}
