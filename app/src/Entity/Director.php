<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DirectorRepository")
 * @ORM\Table(indexes={@ORM\Index(columns={"name"}, flags={"fulltext"})})
 */
class Director
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
     * @ORM\OneToMany(targetEntity="App\Entity\Dvd", mappedBy="director", orphanRemoval=true)
     */
    private $dvds;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bluray", mappedBy="director", orphanRemoval=true)
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
     * @return Collection|Dvd[]
     */
    public function getDvds(): Collection
    {
        return $this->dvds;
    }

    public function addDvd(Dvd $dvd): self
    {
        if (!$this->dvds->contains($dvd)) {
            $this->dvds[] = $dvd;
            $dvd->setDirector($this);
        }

        return $this;
    }

    public function removeDvd(Dvd $dvd): self
    {
        if ($this->dvds->contains($dvd)) {
            $this->dvds->removeElement($dvd);
            // set the owning side to null (unless already changed)
            if ($dvd->getDirector() === $this) {
                $dvd->setDirector(null);
            }
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
            $bluray->setDirector($this);
        }

        return $this;
    }

    public function removeBluray(Bluray $bluray): self
    {
        if ($this->blurays->contains($bluray)) {
            $this->blurays->removeElement($bluray);
            // set the owning side to null (unless already changed)
            if ($bluray->getDirector() === $this) {
                $bluray->setDirector(null);
            }
        }

        return $this;
    }
}
