<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
class Classe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $designation;

    

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_active;

    /**
     * @ORM\ManyToOne(targetEntity=Professeur::class)
     */
    private $titulaire;

    /**
     * @ORM\OneToMany(targetEntity=Cours::class, mappedBy="promotion")
     */
    private $cours;

    /**
     * @ORM\OneToMany(targetEntity=CoursContent::class, mappedBy="classe")
     */
    private $coursContents;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->coursContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }


    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(?bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getTitulaire(): ?Professeur
    {
        return $this->titulaire;
    }

    public function setTitulaire(?Professeur $titulaire): self
    {
        $this->titulaire = $titulaire;

        return $this;
    }

    /**
     * @return Collection|Cours[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setPromotion($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getPromotion() === $this) {
                $cour->setPromotion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CoursContent[]
     */
    public function getCoursContents(): Collection
    {
        return $this->coursContents;
    }

    public function addCoursContent(CoursContent $coursContent): self
    {
        if (!$this->coursContents->contains($coursContent)) {
            $this->coursContents[] = $coursContent;
            $coursContent->setClasse($this);
        }

        return $this;
    }

    public function removeCoursContent(CoursContent $coursContent): self
    {
        if ($this->coursContents->removeElement($coursContent)) {
            // set the owning side to null (unless already changed)
            if ($coursContent->getClasse() === $this) {
                $coursContent->setClasse(null);
            }
        }

        return $this;
    }
}
