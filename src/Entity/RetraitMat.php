<?php

namespace App\Entity;

use App\Repository\RetraitMatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RetraitMatRepository::class)
 */
class RetraitMat
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
    private $motif;

    /**
     * @ORM\ManyToOne(targetEntity=Materiel::class, inversedBy="retraitMats")
     */
    private $idMateriel;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=LocalAffeter::class, mappedBy="idRetrait")
     */
    private $localAffeters;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;


    public function __construct()
    {
        $this->localAffeters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getIdMateriel(): ?Materiel
    {
        return $this->idMateriel;
    }

    public function setIdMateriel(?Materiel $idMateriel): self
    {
        $this->idMateriel = $idMateriel;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|LocalAffeter[]
     */
    public function getLocalAffeters(): Collection
    {
        return $this->localAffeters;
    }

    public function addLocalAffeter(LocalAffeter $localAffeter): self
    {
        if (!$this->localAffeters->contains($localAffeter)) {
            $this->localAffeters[] = $localAffeter;
            $localAffeter->setIdRetrait($this);
        }

        return $this;
    }

    public function removeLocalAffeter(LocalAffeter $localAffeter): self
    {
        if ($this->localAffeters->removeElement($localAffeter)) {
            // set the owning side to null (unless already changed)
            if ($localAffeter->getIdRetrait() === $this) {
                $localAffeter->setIdRetrait(null);
            }
        }

        return $this;
    }

    public function getEntree(): ?int
    {
        return $this->entree;
    }

    public function setEntree(?int $entree): self
    {
        $this->entree = $entree;

        return $this;
    }

    public function getSortie(): ?int
    {
        return $this->sortie;
    }

    public function setSortie(?int $sortie): self
    {
        $this->sortie = $sortie;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

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
}
