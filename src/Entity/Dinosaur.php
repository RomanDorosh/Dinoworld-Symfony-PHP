<?php

namespace App\Entity;

use App\Repository\DinosaurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DinosaurRepository::class)
 */
class Dinosaur
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
     * @ORM\ManyToOne(targetEntity=Period::class, inversedBy="dinosaurs")
     */
    private $period;

    /**
     * @ORM\ManyToOne(targetEntity=Diet::class, inversedBy="dinosaurs")
     */
    private $diet;

    /**
     * @ORM\ManyToOne(targetEntity=Continent::class, inversedBy="dinosaurs")
     */
    private $continent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $top_speed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lenght;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $img;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $top;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="dinosaurus")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getDiet(): ?Diet
    {
        return $this->diet;
    }

    public function setDiet(?Diet $diet): self
    {
        $this->diet = $diet;

        return $this;
    }

    public function getContinent(): ?Continent
    {
        return $this->continent;
    }

    public function setContinent(?Continent $continent): self
    {
        $this->continent = $continent;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getTopSpeed(): ?int
    {
        return $this->top_speed;
    }

    public function setTopSpeed(?int $top_speed): self
    {
        $this->top_speed = $top_speed;

        return $this;
    }

    public function getLenght(): ?int
    {
        return $this->lenght;
    }

    public function setLenght(?int $lenght): self
    {
        $this->lenght = $lenght;

        return $this;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getTop(): ?bool
    {
        return $this->top;
    }

    public function setTop(?bool $top): self
    {
        $this->top = $top;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addDinosauru($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeDinosauru($this);
        }

        return $this;
    }
}
