<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseignantRepository::class)]
class Enseignant extends Utilisateur
{
    

    

    #[ORM\OneToOne(mappedBy: 'enseignant', cascade: ['persist', 'remove'])]
    private ?Cours $cours = null;

    public function getId(): ?int
    {
        return parent::getId();
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(Cours $cours): static
    {
        // set the owning side of the relation if necessary
        if ($cours->getEnseignant() !== $this) {
            $cours->setEnseignant($this);
        }

        $this->cours = $cours;

        return $this;
    }

   
}
