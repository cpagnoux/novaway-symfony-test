<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActorRepository")
 */
class Actor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\DVD", mappedBy="actors")
     */
    private $dvds;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Bluray", mappedBy="actors")
     */
    private $blurays;

    public function __construct()
    {
        $this->dvds = new ArrayCollection();
        $this->blurays = new ArrayCollection();
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

    /**
     * @return Collection|DVD[]
     */
    public function getDvds(): Collection
    {
        return $this->dvds;
    }

    public function addDvd(DVD $dvd): self
    {
        if (!$this->dvds->contains($dvd)) {
            $this->dvds[] = $dvd;
            $dvd->addActor($this);
        }

        return $this;
    }

    public function removeDvd(DVD $dvd): self
    {
        if ($this->dvds->contains($dvd)) {
            $this->dvds->removeElement($dvd);
            $dvd->removeActor($this);
        }

        return $this;
    }

    /**
     * @return Collection|Bluray[]
     */
    public function getBlurays(): Collection
    {
        return $this->blurays;
    }

    public function addBluray(Bluray $bluray): self
    {
        if (!$this->blurays->contains($bluray)) {
            $this->blurays[] = $bluray;
            $bluray->addActor($this);
        }

        return $this;
    }

    public function removeBluray(Bluray $bluray): self
    {
        if ($this->blurays->contains($bluray)) {
            $this->blurays->removeElement($bluray);
            $bluray->removeActor($this);
        }

        return $this;
    }
}
