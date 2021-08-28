<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Profile", mappedBy="category")
     */
    private $profiles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HelpWanted", mappedBy="category")
     */
    private $helpWanted;

    public function __construct()
    {
        $this->profiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Profile[]
     */
    public function getProfiles(): Collection
    {
        return $this->profiles;
    }

    public function addProfile(Profile $profile): self
    {
        if (!$this->profiles->contains($profile)) {
            $this->profiles[] = $profile;
            $profile->addCategory($this);
        }

        return $this;
    }

    public function removeProfile(Profile $profile): self
    {
        if ($this->profiles->contains($profile)) {
            $this->profiles->removeElement($profile);
            $profile->removeCategory($this);
        }

        return $this;
    }

    public function getHelpWanted(): ?HelpWanted
    {
        return $this->helpWanted;
    }

    public function setHelpWanted(HelpWanted $helpWanted): self
    {
        $this->helpWanted = $helpWanted;

        // set the owning side of the relation if necessary
        if ($helpWanted->getCategory() !== $this) {
            $helpWanted->setCategory($this);
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->title;
    }
}
