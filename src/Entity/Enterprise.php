<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EnterpriseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EnterpriseRepository::class)
 */
class Enterprise
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
     * @ORM\Column(type="string", length=255)
     */
    private $Location;

    /**
     * @ORM\Column(type="integer")
     */
    private $Zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Siret;

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

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->Zipcode;
    }

    public function setZipcode(int $Zipcode): self
    {
        $this->Zipcode = $Zipcode;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->Siret;
    }

    public function setSiret(string $Siret): self
    {
        $this->Siret = $Siret;

        return $this;
    }
}
