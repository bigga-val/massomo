<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 */
class Eleve
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
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lieu_naissance;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Tuteur::class)
     */
    private $tuteur;

    /**
     * @ORM\ManyToOne(targetEntity=Etat::class)
     */
    private $etat;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=Parents::class, inversedBy="eleves")
     */
    private $parents;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $maladieChronique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomMaladie;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $aptePhysique;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $certificatMedical;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $photographier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

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

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieu_naissance;
    }

    public function setLieuNaissance(?string $lieu_naissance): self
    {
        $this->lieu_naissance = $lieu_naissance;

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getTuteur(): ?Tuteur
    {
        return $this->tuteur;
    }

    public function setTuteur(?Tuteur $tuteur): self
    {
        $this->tuteur = $tuteur;

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getParents(): ?Parents
    {
        return $this->parents;
    }

    public function setParents(?Parents $parents): self
    {
        $this->parents = $parents;

        return $this;
    }

    public function getMaladieChronique(): ?string
    {
        return $this->maladieChronique;
    }

    public function setMaladieChronique(string $maladieChronique): self
    {
        $this->maladieChronique = $maladieChronique;

        return $this;
    }

    public function getNomMaladie(): ?string
    {
        return $this->nomMaladie;
    }

    public function setNomMaladie(string $nomMaladie): self
    {
        $this->nomMaladie = $nomMaladie;

        return $this;
    }

    public function getAptePhysique(): ?bool
    {
        return $this->aptePhysique;
    }

    public function setAptePhysique(?bool $aptePhysique): self
    {
        $this->aptePhysique = $aptePhysique;

        return $this;
    }

    public function getCertificatMedical()
    {
        return $this->certificatMedical;
    }

    public function setCertificatMedical($certificatMedical): self
    {
        $this->certificatMedical = $certificatMedical;

        return $this;
    }

    public function getPhotographier(): ?bool
    {
        return $this->photographier;
    }

    public function setPhotographier(?bool $photographier): self
    {
        $this->photographier = $photographier;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }
}
