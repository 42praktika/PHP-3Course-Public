<?php

namespace App\Entity;

use App\Repository\StreetsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StreetsRepository::class)
 */
class Streets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     *
     */
    private $Index;

    /**
     * @ORM\OneToMany(targetEntity=Buildings::class, mappedBy="street", orphanRemoval=true)
     */
    private $Buildings;

    public function __construct()
    {
        $this->Buildings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getIndex(): ?string
    {
        return $this->Index;
    }

    public function setIndex(?string $Index): self
    {
        $this->Index = $Index;

        return $this;
    }

    /**
     * @return Collection|Buildings[]
     */
    public function getBuildings(): Collection
    {
        return $this->Buildings;
    }

    public function addBuilding(Buildings $building): self
    {
        if (!$this->Buildings->contains($building)) {
            $this->Buildings[] = $building;
            $building->setStreet($this);
        }

        return $this;
    }

    public function removeBuilding(Buildings $building): self
    {
        if ($this->Buildings->removeElement($building)) {
            // set the owning side to null (unless already changed)
            if ($building->getStreet() === $this) {
                $building->setStreet(null);
            }
        }

        return $this;
    }
}
