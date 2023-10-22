<?php

namespace App\Entity;

use App\Repository\TuteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TuteurRepository::class)
 */
class Tuteur
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
    private $nom_complet;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseTuteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephoneBureau;

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

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getAdresseTuteur(): ?string
    {
        return $this->adresseTuteur;
    }

    public function setAdresseTuteur(string $adresseTuteur): self
    {
        $this->adresseTuteur = $adresseTuteur;

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
}