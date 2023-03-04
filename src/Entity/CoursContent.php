<?php

namespace App\Entity;

use App\Repository\CoursContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursContentRepository::class)
 */
class CoursContent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class, inversedBy="coursContents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCours;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $chapitre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenue;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="coursContents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;

    /**
     * @ORM\ManyToOne(targetEntity=Professeur::class, inversedBy="coursContents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prof;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $fileCours;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCours(): ?Cours
    {
        return $this->idCours;
    }

    public function setIdCours(?Cours $idCours): self
    {
        $this->idCours = $idCours;

        return $this;
    }

    public function getChapitre(): ?string
    {
        return $this->chapitre;
    }

    public function setChapitre(string $chapitre): self
    {
        $this->chapitre = $chapitre;

        return $this;
    }

    public function getContenue(): ?string
    {
        return $this->contenue;
    }

    public function setContenue(string $contenue): self
    {
        $this->contenue = $contenue;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getProf(): ?Professeur
    {
        return $this->prof;
    }

    public function setProf(?Professeur $prof): self
    {
        $this->prof = $prof;

        return $this;
    }

    public function getFileCours()
    {
        return $this->fileCours;
    }

    public function setFileCours($fileCours): self
    {
        $this->fileCours = $fileCours;

        return $this;
    }
}
