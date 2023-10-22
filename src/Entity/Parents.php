<?php

namespace App\Entity;

use App\Repository\ParentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParentsRepository::class)
 */
class Parents
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomPere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Profession;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AdresseDomicile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephonePrive;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephoneBureau;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomMere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $professionMere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AdresseMere;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephoneMerePrive;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephoneMereBureau;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $actif;

    /**
     * @ORM\OneToMany(targetEntity=Eleve::class, mappedBy="parents")
     */
    private $eleves;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPere(): ?string
    {
        return $this->nomPere;
    }

    public function setNomPere(string $nomPere): self
    {
        $this->nomPere = $nomPere;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->Profession;
    }

    public function setProfession(string $Profession): self
    {
        $this->Profession = $Profession;

        return $this;
    }

    public function getAdresseDomicile(): ?string
    {
        return $this->AdresseDomicile;
    }

    public function setAdresseDomicile(string $AdresseDomicile): self
    {
        $this->AdresseDomicile = $AdresseDomicile;

        return $this;
    }

    public function getTelephonePrive(): ?string
    {
        return $this->telephonePrive;
    }

    public function setTelephonePrive(string $telephonePrive): self
    {
        $this->telephonePrive = $telephonePrive;

        return $this;
    }

    public function getTelephoneBureau(): ?int
    {
        return $this->telephoneBureau;
    }

    public function setTelephoneBureau(int $telephoneBureau): self
    {
        $this->telephoneBureau = $telephoneBureau;

        return $this;
    }

    public function getNomMere(): ?string
    {
        return $this->nomMere;
    }

    public function setNomMere(string $nomMere): self
    {
        $this->nomMere = $nomMere;

        return $this;
    }

    public function getProfessionMere(): ?string
    {
        return $this->professionMere;
    }

    public function setProfessionMere(string $professionMere): self
    {
        $this->professionMere = $professionMere;

        return $this;
    }

    public function getAdresseMere(): ?string
    {
        return $this->AdresseMere;
    }

    public function setAdresseMere(string $AdresseMere): self
    {
        $this->AdresseMere = $AdresseMere;

        return $this;
    }

    public function getTelephoneMerePrive(): ?int
    {
        return $this->telephoneMerePrive;
    }

    public function setTelephoneMerePrive(int $telephoneMerePrive): self
    {
        $this->telephoneMerePrive = $telephoneMerePrive;

        return $this;
    }

    public function getTelephoneMereBureau(): ?int
    {
        return $this->telephoneMereBureau;
    }

    public function setTelephoneMereBureau(int $telephoneMereBureau): self
    {
        $this->telephoneMereBureau = $telephoneMereBureau;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return Collection|Eleve[]
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleve $elefe): self
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves[] = $elefe;
            $elefe->setParents($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): self
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getParents() === $this) {
                $elefe->setParents(null);
            }
        }

        return $this;
    }
}
