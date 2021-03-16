<?php

namespace App\Entity;

use App\Repository\PeriodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeriodRepository::class)
 */
class Period
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Dinosaur::class, mappedBy="Period")
     */
    private $dinosaurs;

    public function __construct()
    {
        $this->dinosaurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->id . ' - ' . $this->name;
    }

    /**
     * @return Collection|Dinosaur[]
     */
    public function getDinosaurs(): Collection
    {
        return $this->dinosaurs;
    }

    public function addDinosaur(Dinosaur $dinosaur): self
    {
        if (!$this->dinosaurs->contains($dinosaur)) {
            $this->dinosaurs[] = $dinosaur;
            $dinosaur->setPeriod($this);
        }

        return $this;
    }

    public function removeDinosaur(Dinosaur $dinosaur): self
    {
        if ($this->dinosaurs->removeElement($dinosaur)) {
            // set the owning side to null (unless already changed)
            if ($dinosaur->getPeriod() === $this) {
                $dinosaur->setPeriod(null);
            }
        }

        return $this;
    }
}
