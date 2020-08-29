<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 */
class Groupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $codegroupe;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $libellegroupe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodegroupe(): ?string
    {
        return $this->codegroupe;
    }

    public function setCodegroupe(string $codegroupe): self
    {
        $this->codegroupe = $codegroupe;

        return $this;
    }

    public function getLibellegroupe(): ?string
    {
        return $this->libellegroupe;
    }

    public function setLibellegroupe(string $libellegroupe): self
    {
        $this->libellegroupe = $libellegroupe;

        return $this;
    }
}
