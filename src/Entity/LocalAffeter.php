<?php

namespace App\Entity;

use App\Repository\LocalAffeterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocalAffeterRepository::class)
 */
class LocalAffeter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroLocal;

    /**
     * @ORM\ManyToOne(targetEntity=RetraitMat::class, inversedBy="localAffeters")
     */
    private $idRetrait;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroLocal(): ?int
    {
        return $this->numeroLocal;
    }

    public function setNumeroLocal(int $numeroLocal): self
    {
        $this->numeroLocal = $numeroLocal;

        return $this;
    }

    public function getIdRetrait(): ?RetraitMat
    {
        return $this->idRetrait;
    }

    public function setIdRetrait(?RetraitMat $idRetrait): self
    {
        $this->idRetrait = $idRetrait;

        return $this;
    }
}
