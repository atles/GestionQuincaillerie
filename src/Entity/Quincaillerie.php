<?php

namespace App\Entity;

use App\Repository\QuincaillerieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuincaillerieRepository::class)
 */
class Quincaillerie
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
    private $libellequic;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $codequinc;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $longe;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $lat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibellequic(): ?string
    {
        return $this->libellequic;
    }

    public function setLibellequic(string $libellequic): self
    {
        $this->libellequic = $libellequic;

        return $this;
    }

    public function getCodequinc(): ?string
    {
        return $this->codequinc;
    }

    public function setCodequinc(string $codequinc): self
    {
        $this->codequinc = $codequinc;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getLonge(): ?string
    {
        return $this->longe;
    }

    public function setLonge(string $longe): self
    {
        $this->longe = $longe;

        return $this;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }
}
