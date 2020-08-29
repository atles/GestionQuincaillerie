<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixencours;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $unite;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $codearticle;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=quincaillerie::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $quincaillerie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrixencours(): ?int
    {
        return $this->prixencours;
    }

    public function setPrixencours(int $prixencours): self
    {
        $this->prixencours = $prixencours;

        return $this;
    }

    public function getUnite(): ?string
    {
        return $this->unite;
    }

    public function setUnite(string $unite): self
    {
        $this->unite = $unite;

        return $this;
    }

    public function getCodearticle(): ?string
    {
        return $this->codearticle;
    }

    public function setCodearticle(string $codearticle): self
    {
        $this->codearticle = $codearticle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuincaillerie(): ?quincaillerie
    {
        return $this->quincaillerie;
    }

    public function setQuincaillerie(?quincaillerie $quincaillerie): self
    {
        $this->quincaillerie = $quincaillerie;

        return $this;
    }
}
