<?php

namespace App\Entity;

use App\Repository\ModifprixRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModifprixRepository::class)
 */
class Modifprix
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datemodif;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $remarque;

    /**
     * @ORM\Column(type="integer")
     */
    private $ancienprix;

    /**
     * @ORM\ManyToOne(targetEntity=article::class)
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatemodif(): ?\DateTimeInterface
    {
        return $this->datemodif;
    }

    public function setDatemodif(\DateTimeInterface $datemodif): self
    {
        $this->datemodif = $datemodif;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    public function getAncienprix(): ?int
    {
        return $this->ancienprix;
    }

    public function setAncienprix(int $ancienprix): self
    {
        $this->ancienprix = $ancienprix;

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
