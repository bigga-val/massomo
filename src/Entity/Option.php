<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OptionRepository::class)
 * @ORM\Table(name="`Option`")
 */
class Option
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
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="idOption")
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="idOption")
     */
    private $id_option;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->id_option = new ArrayCollection();
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

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setIdOption($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getIdOption() === $this) {
                $inscription->setIdOption(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getIdOption(): Collection
    {
        return $this->id_option;
    }

    public function addIdOption(Inscription $idOption): self
    {
        if (!$this->id_option->contains($idOption)) {
            $this->id_option[] = $idOption;
            $idOption->setIdOption($this);
        }

        return $this;
    }

    public function removeIdOption(Inscription $idOption): self
    {
        if ($this->id_option->removeElement($idOption)) {
            // set the owning side to null (unless already changed)
            if ($idOption->getIdOption() === $this) {
                $idOption->setIdOption(null);
            }
        }

        return $this;
    }
}
