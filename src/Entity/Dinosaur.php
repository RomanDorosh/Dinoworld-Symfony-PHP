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
     * @ORM\ManyToOne(targetEntity=period::class, inversedBy="dinosaurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $period;

    /**
     * @ORM\ManyToOne(targetEntity=diet::class, inversedBy="dinosaurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $diet;

    /**
     * @ORM\ManyToOne(targetEntity=continent::class, inversedBy="dinosaurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $continent;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     */
    private $height;

    /**
     * @ORM\Column(type="integer")
     */
    private $lenght;

    /**
     * @ORM\Column(type="integer")
     */
    private $top_speed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $top;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="dinosaur")
     */
    private $users;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $info;

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

    public function getPeriod(): ?period
    {
        return $this->period;
    }

    public function setPeriod(?period $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getDiet(): ?diet
    {
        return $this->diet;
    }

    public function setDiet(?diet $diet): self
    {
        $this->diet = $diet;

        return $this;
    }

    public function getContinent(): ?continent
    {
        return $this->continent;
    }

    public function setContinent(?continent $continent): self
    {
        $this->continent = $continent;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getLenght(): ?int
    {
        return $this->lenght;
    }

    public function setLenght(int $lenght): self
    {
        $this->lenght = $lenght;

        return $this;
    }

    public function getTopSpeed(): ?int
    {
        return $this->top_speed;
    }

    public function setTopSpeed(int $top_speed): self
    {
        $this->top_speed = $top_speed;

        return $this;
    }

    public function getTop(): ?bool
    {
        return $this->top;
    }

    public function setTop(bool $top): self
    {
        $this->top = $top;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

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
            $user->addDinosaur($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeDinosaur($this);
        }

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(?string $info): self
    {
        $this->info = $info;

        return $this;
    }
}
