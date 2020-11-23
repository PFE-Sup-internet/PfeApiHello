<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TripRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 * denormalizationContext={"groups"={"trip:write"}},
 * )
 * @ORM\Entity(repositoryClass=TripRepository::class)
 */
class Trip
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"user:read","trip:write"})
     */
    private $notation;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="trip", orphanRemoval=true)
     * @Groups({"user:read"})
     */
    private $step;

    /**
     * @ORM\Column(type="text")
     * @Groups({"user:read","trip:write"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="trips")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"trip:write"})
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","trip:write"})
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="trips")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user:read","trip:write"})
     */
    private $type;

    public function __construct()
    {
        $this->step = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotation(): ?int
    {
        return $this->notation;
    }

    public function setNotation(int $notation): self
    {
        $this->notation = $notation;

        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    public function getStep(): Collection
    {
        return $this->step;
    }

    public function addStep(Location $step): self
    {
        if (!$this->step->contains($step)) {
            $this->step[] = $step;
            $step->setTrip($this);
        }

        return $this;
    }

    public function removeStep(Location $step): self
    {
        if ($this->step->contains($step)) {
            $this->step->removeElement($step);
            // set the owning side to null (unless already changed)
            if ($step->getTrip() === $this) {
                $step->setTrip(null);
            }
        }

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

    public function getAuthor(): ?Person
    {
        return $this->author;
    }

    public function setAuthor(?Person $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }
}
