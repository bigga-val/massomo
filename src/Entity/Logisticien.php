<?php

namespace App\Entity;

use App\Repository\LogisticienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogisticienRepository::class)
 */
class Logisticien
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
    private $nomLogisticien;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseMail;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=EtablirBesoin::class, mappedBy="createdBy")
     */
    private $etablirBesoins;

    public function __construct()
    {
        $this->etablirBesoins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLogisticien(): ?string
    {
        return $this->nomLogisticien;
    }

    public function setNomLogisticien(string $nomLogisticien): self
    {
        $this->nomLogisticien = $nomLogisticien;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

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
     * @return Collection|EtablirBesoin[]
     */
    public function getEtablirBesoins(): Collection
    {
        return $this->etablirBesoins;
    }

    public function addEtablirBesoin(EtablirBesoin $etablirBesoin): self
    {
        if (!$this->etablirBesoins->contains($etablirBesoin)) {
            $this->etablirBesoins[] = $etablirBesoin;
            $etablirBesoin->setCreatedBy($this);
        }

        return $this;
    }

    public function removeEtablirBesoin(EtablirBesoin $etablirBesoin): self
    {
        if ($this->etablirBesoins->removeElement($etablirBesoin)) {
            // set the owning side to null (unless already changed)
            if ($etablirBesoin->getCreatedBy() === $this) {
                $etablirBesoin->setCreatedBy(null);
            }
        }

        return $this;
    }
}
