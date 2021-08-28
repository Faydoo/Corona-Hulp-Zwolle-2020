<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfileRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Profile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="profile")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $displayName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telnum;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="profiles")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="profiles")
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HelpWanted", mappedBy="profile")
     */
    private $helpWanted;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $helpOfferedTitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $helpOfferedText;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible = true;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->helpWanted = new ArrayCollection();
        $this->helpOffered = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getTelnum(): ?string
    {
        return $this->telnum;
    }

    public function setTelnum(?string $telnum): self
    {
        $this->telnum = $telnum;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

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

    /**
     * @return Collection|HelpWanted[]
     */
    public function getHelpWanted(): Collection
    {
        return $this->helpWanted;
    }

    public function addHelpWanted(HelpWanted $helpWanted): self
    {
        if (!$this->helpWanted->contains($helpWanted)) {
            $this->helpWanted[] = $helpWanted;
            $helpWanted->setProfile($this);
        }

        return $this;
    }

    public function removeHelpWanted(HelpWanted $helpWanted): self
    {
        if ($this->helpWanted->contains($helpWanted)) {
            $this->helpWanted->removeElement($helpWanted);
            // set the owning side to null (unless already changed)
            if ($helpWanted->getProfile() === $this) {
                $helpWanted->setProfile(null);
            }
        }

        return $this;
    }

    public function getHelpOfferedTitle(): ?string
    {
        return $this->helpOfferedTitle;
    }

    public function setHelpOfferedTitle(string $helpOfferedTitle): self
    {
        $this->helpOfferedTitle = $helpOfferedTitle;

        return $this;
    }

    public function getHelpOfferedText(): ?string
    {
        return $this->helpOfferedText;
    }

    public function setHelpOfferedText(?string $helpOfferedText): self
    {
        $this->helpOfferedText = $helpOfferedText;

        return $this;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }
}