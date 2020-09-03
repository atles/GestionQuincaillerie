<?php

namespace App\Entity;

use App\Repository\OperationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperationRepository::class)
 */
class Operation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=typeoperation::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeoperation;

    /**
     * @ORM\ManyToOne(targetEntity=client::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=lignecommande::class)
     */
    private $lignecommande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeoperation(): ?typeoperation
    {
        return $this->typeoperation;
    }

    public function setTypeoperation(?typeoperation $typeoperation): self
    {
        $this->typeoperation = $typeoperation;

        return $this;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getLignecommande(): ?lignecommande
    {
        return $this->lignecommande;
    }

    public function setLignecommande(?lignecommande $lignecommande): self
    {
        $this->lignecommande = $lignecommande;

        return $this;
    }
}
