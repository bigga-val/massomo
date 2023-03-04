<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfesseurRepository::class)
 */
class Professeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom_complet;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieu_naissance;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_naissance;

    /**
     * @ORM\OneToMany(targetEntity=Cours::class, mappedBy="professeur")
     */
    private $cours;

    /**
     * @ORM\OneToMany(targetEntity=CoursContent::class, mappedBy="prof")
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

    public function getNomComplet(): ?string
    {
        return $this->nom_complet;
    }

    public function setNomComplet(string $nom_complet): self
    {
        $this->nom_complet = $nom_complet;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
    public function getLieuNaissance():?String
    {
        return $this->lieu_naissance;
    }
    
   public function setLieuNaissance(?string $lieu_naissance){
    $this->lieu_naissance = $lieu_naissance;
    return $this;
   }

    public function getDateNaissance(): ?string
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?string $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

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
            $cour->setProfesseur($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getProfesseur() === $this) {
                $cour->setProfesseur(null);
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
            $coursContent->setProf($this);
        }

        return $this;
    }

    public function removeCoursContent(CoursContent $coursContent): self
    {
        if ($this->coursContents->removeElement($coursContent)) {
            // set the owning side to null (unless already changed)
            if ($coursContent->getProf() === $this) {
                $coursContent->setProf(null);
            }
        }

        return $this;
    }
}
