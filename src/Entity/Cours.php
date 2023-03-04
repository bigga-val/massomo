<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
class Cours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $designation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_active;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="cours")
     */
    private $promotion;

    /**
     * @ORM\ManyToOne(targetEntity=Professeur::class, inversedBy="cours")
     */
    private $professeur;

    /**
     * @ORM\OneToMany(targetEntity=CoursContent::class, mappedBy="idCours")
     */
    private $coursContents;

    public function __construct()
    {
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

    public function setDesignation(?string $designation): self
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

    public function getPromotion(): ?Classe
    {
        return $this->promotion;
    }

    public function setPromotion(?Classe $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): self
    {
        $this->professeur = $professeur;

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
            $coursContent->setIdCours($this);
        }

        return $this;
    }

    public function removeCoursContent(CoursContent $coursContent): self
    {
        if ($this->coursContents->removeElement($coursContent)) {
            // set the owning side to null (unless already changed)
            if ($coursContent->getIdCours() === $this) {
                $coursContent->setIdCours(null);
            }
        }

        return $this;
    }
}
