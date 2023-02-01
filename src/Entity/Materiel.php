<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielRepository::class)
 */
class Materiel
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
    private $nomMateriel;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="date")
     */
    private $dateAchat;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="materiels")
     */
    private $idFournisseur;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity=RetraitMat::class, mappedBy="idMateriel")
     */
    private $retraitMats;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieMat::class, inversedBy="materiels")
     */
    private $idCategorie;

    public function __construct()
    {
        $this->retraitMats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMateriel(): ?string
    {
        return $this->nomMateriel;
    }

    public function setNomMateriel(string $nomMateriel): self
    {
        $this->nomMateriel = $nomMateriel;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getIdFournisseur(): ?Fournisseur
    {
        return $this->idFournisseur;
    }

    public function setIdFournisseur(?Fournisseur $idFournisseur): self
    {
        $this->idFournisseur = $idFournisseur;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(?bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection|RetraitMat[]
     */
    public function getRetraitMats(): Collection
    {
        return $this->retraitMats;
    }

    public function addRetraitMat(RetraitMat $retraitMat): self
    {
        if (!$this->retraitMats->contains($retraitMat)) {
            $this->retraitMats[] = $retraitMat;
            $retraitMat->setIdMateriel($this);
        }

        return $this;
    }

    public function removeRetraitMat(RetraitMat $retraitMat): self
    {
        if ($this->retraitMats->removeElement($retraitMat)) {
            // set the owning side to null (unless already changed)
            if ($retraitMat->getIdMateriel() === $this) {
                $retraitMat->setIdMateriel(null);
            }
        }

        return $this;
    }

    public function getIdCategorie(): ?CategorieMat
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(?CategorieMat $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }
}
