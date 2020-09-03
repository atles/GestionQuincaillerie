<?php

namespace App\Entity;

use App\Repository\LignecommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LignecommandeRepository::class)
 */
class Lignecommande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $pu;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $qte;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $unit;

    /**
     * @ORM\ManyToOne(targetEntity=commande::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=article::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPu(): ?string
    {
        return $this->pu;
    }

    public function setPu(?string $pu): self
    {
        $this->pu = $pu;

        return $this;
    }

    public function getQte(): ?string
    {
        return $this->qte;
    }

    public function setQte(?string $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getCommande(): ?commande
    {
        return $this->commande;
    }

    public function setCommande(?commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getArticle(): ?article
    {
        return $this->article;
    }

    public function setArticle(?article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
