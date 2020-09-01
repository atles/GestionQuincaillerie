<?php

namespace App\Entity;

use App\Repository\TypeoperationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeoperationRepository::class)
 */
class Typeoperation
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
    private $typeoperation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeoperation(): ?string
    {
        return $this->typeoperation;
    }

    public function setTypeoperation(string $typeoperation): self
    {
        $this->typeoperation = $typeoperation;

        return $this;
    }
}
