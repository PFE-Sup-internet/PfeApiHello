<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Repository\TaskRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->assignedUsers = new ArrayCollection();
        $this->documents = new ArrayCollection();
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at",type="datetime")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at",type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="tasksUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creator;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="task")
     */
    private $messages;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Person", mappedBy="assignedTasks")
     */
    private $assignedUsers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fileLinked;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fileLinkedType;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    public function getCreator(): ?Person
    {
        return $this->creator;
    }

    public function setCreator(?Person $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }
    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            //   $message->setArticle($this);
        }
        return $this;
    }
    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            // if ($message->getArticle() === $this) {
            //     $message->setArticle(null);
            // }
        }
        return $this;
    }



    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getAssignedUsers(): Collection
    {
        return $this->assignedUsers;
    }

    public function addAssignedUser(Person $assignedUser): self
    {
        if (!$this->assignedUsers->contains($assignedUser)) {
            $this->assignedUsers[] = $assignedUser;
            $assignedUser->addAssignedTask($this);
        }

        return $this;
    }

    public function removeAssignedUser(Person $assignedUser): self
    {
        if ($this->assignedUsers->contains($assignedUser)) {
            $this->assignedUsers->removeElement($assignedUser);
            $assignedUser->removeAssignedTask($this);
        }

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    // /**
    //  * toString
    //  * @return string
    //  */
    // public function __toString()
    // {
    //     return $this->getUsername();
    // }



    /**
     * Get the value of fileLinked
     */
    public function getFileLinked()
    {
        return $this->fileLinked;
    }

    /**
     * Set the value of fileLinked
     *
     * @return  self
     */
    public function setFileLinked($fileLinked)
    {
        $this->fileLinked = $fileLinked;

        return $this;
    }

    /**
     * Get the value of fileLinkedType
     */
    public function getFileLinkedType()
    {
        return $this->fileLinkedType;
    }

    /**
     * Set the value of fileLinkedType
     *
     * @return  self
     */
    public function setFileLinkedType($fileLinkedType)
    {
        $this->fileLinkedType = $fileLinkedType;

        return $this;
    }
}
