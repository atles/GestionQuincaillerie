<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private $user;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $tel;

    /**
     * @ORM\ManyToOne(targetEntity=quincaillerie::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $quincaillerie_id;

    /**
     * @ORM\ManyToOne(targetEntity=groupe::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupe_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

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

    public function getQuincaillerieId(): ?quincaillerie
    {
        return $this->quincaillerie_id;
    }

    public function setQuincaillerieId(?quincaillerie $quincaillerie_id): self
    {
        $this->quincaillerie_id = $quincaillerie_id;

        return $this;
    }

    public function getGroupeId(): ?groupe
    {
        return $this->groupe_id;
    }

    public function setGroupeId(?groupe $groupe_id): self
    {
        $this->groupe_id = $groupe_id;

        return $this;
    }
}
