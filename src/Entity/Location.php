<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * denormalizationContext={"groups"={"location:write"}},
 * )
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user:read","location:write"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user:read","location:write"})
     */
    private $longitude;

    /**
     * @ORM\Column(type="text")
     * @Groups({"user:read","location:write"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Trip::class, inversedBy="step")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"location:write"})
     */
    private $trip;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","location:write"})
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

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

    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    public function setTrip(?Trip $trip): self
    {
        $this->trip = $trip;

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
}
