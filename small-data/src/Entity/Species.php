<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpeciesRepository")
 */
class Species
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", unique=true)
     */
    private $wormsAphiaId;

    /**
     * @ORM\Column(type="text")
     */
    private $speciesNameWorms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Occurrence", mappedBy="species")
     */
    private $occurrences;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phylum;

    public function __construct()
    {
        $this->occurrences = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getWormsAphiaId(): ?string
    {
        return $this->wormsAphiaId;
    }

    public function setWormsAphiaId(string $wormsAphiaId): self
    {
        $this->wormsAphiaId = $wormsAphiaId;

        return $this;
    }

    public function getSpeciesNameWorms(): ?string
    {
        return $this->speciesNameWorms;
    }

    public function setSpeciesNameWorms(string $speciesNameWorms): self
    {
        $this->speciesNameWorms = $speciesNameWorms;

        return $this;
    }

    /**
     * @return Collection|Occurrence[]
     */
    public function getOccurrences(): Collection
    {
        return $this->occurrences;
    }

    public function addOccurrence(Occurrence $occurrence): self
    {
        if (!$this->occurrences->contains($occurrence)) {
            $this->occurrences[] = $occurrence;
            $occurrence->setSpecies($this);
        }

        return $this;
    }

    public function removeOccurrence(Occurrence $occurrence): self
    {
        if ($this->occurrences->contains($occurrence)) {
            $this->occurrences->removeElement($occurrence);
            // set the owning side to null (unless already changed)
            if ($occurrence->getSpecies() === $this) {
                $occurrence->setSpecies(null);
            }
        }

        return $this;
    }

    public function getPhylum(): ?string
    {
        return $this->phylum;
    }

    public function setPhylum(?string $phylum): self
    {
        $this->phylum = $phylum;

        return $this;
    }
}
