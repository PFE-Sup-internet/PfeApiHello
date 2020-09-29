<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 * @ApiResource()
 * 
 */
class Team
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
     * @ORM\ManyToMany(targetEntity=Person::class, inversedBy="teams")
     */
    private $Members;

    public function __construct()
    {
        $this->Members = new ArrayCollection();
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

    /**
     * @return Collection|Person[]
     */
    public function getMembers(): Collection
    {
        return $this->Members;
    }

    public function addMember(Person $member): self
    {
        if (!$this->Members->contains($member)) {
            $this->Members[] = $member;
        }

        return $this;
    }

    public function removeMember(Person $member): self
    {
        if ($this->Members->contains($member)) {
            $this->Members->removeElement($member);
        }

        return $this;
    }
}
