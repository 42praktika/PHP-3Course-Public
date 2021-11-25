<?php

namespace App\Entity;

use App\Repository\BuildingsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BuildingsRepository::class)
 */
class Buildings
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Number;

    /**
     * @ORM\ManyToOne(targetEntity=Streets::class, inversedBy="Buildings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $street;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->Number;
    }

    public function setNumber(string $Number): self
    {
        $this->Number = $Number;

        return $this;
    }

    public function getStreet(): ?Streets
    {
        return $this->street;
    }

    public function setStreet(?Streets $street): self
    {
        $this->street = $street;

        return $this;
    }
}
