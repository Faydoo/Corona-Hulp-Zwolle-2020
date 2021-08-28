<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HelpWantedRepository")
 */
class HelpWanted
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profile", inversedBy="helpWanted")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="helpWanted")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="helpWanted")
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $executionDateTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duration;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HelpWantedMessage", mappedBy="helpWanted")
     */
    private $helpWantedMessages;

    public function __construct()
    {
        $this->helpWantedMessages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getExecutionDateTime(): ?\DateTimeInterface
    {
        return $this->executionDateTime;
    }

    public function setExecutionDateTime(?\DateTimeInterface $executionDateTime): self
    {
        $this->executionDateTime = $executionDateTime;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection|HelpWantedMessage[]
     */
    public function getHelpWantedMessages(): Collection
    {
        return $this->helpWantedMessages;
    }

    public function addHelpWantedMessage(HelpWantedMessage $helpWantedMessage): self
    {
        if (!$this->helpWantedMessages->contains($helpWantedMessage)) {
            $this->helpWantedMessages[] = $helpWantedMessage;
            $helpWantedMessage->setHelpWanted($this);
        }

        return $this;
    }

    public function removeHelpWantedMessage(HelpWantedMessage $helpWantedMessage): self
    {
        if ($this->helpWantedMessages->contains($helpWantedMessage)) {
            $this->helpWantedMessages->removeElement($helpWantedMessage);
            // set the owning side to null (unless already changed)
            if ($helpWantedMessage->getHelpWanted() === $this) {
                $helpWantedMessage->setHelpWanted(null);
            }
        }

        return $this;
    }
}
