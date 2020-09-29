<?php

namespace App\Entity;

use App\Entity\Plan;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SubscriptionRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SubscriptionRepository::class)
 */
class Subscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\OneToOne(targetEntity=Enterprise::class, cascade={"persist", "remove"})
     */
    private $CLient;

    /**
     * @ORM\ManyToOne(targetEntity=Plan::class, inversedBy="subscriptions")
     */
    private $Plan;

    public function __construct()
    {
        $this->Plan = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCLient(): ?Enterprise
    {
        return $this->CLient;
    }

    public function setCLient(?Enterprise $CLient): self
    {
        $this->CLient = $CLient;

        return $this;
    }

    public function getPlan(): Collection
    {
        return $this->Plan;
    }

    public function setPlan(?Plan $Plan): self
    {
        $this->Plan = $Plan;

        return $this;
    }
}
