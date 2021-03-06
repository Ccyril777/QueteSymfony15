<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeasonRepository")
 */
class Season
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Program", inversedBy="seasons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $programs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Episodes", mappedBy="season")
     */
    private $episodes;

    public function __construct()
    {
        $this->seasons = new ArrayCollection();
        $this->episodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

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

    public function getPrograms(): ?Program
    {
        return $this->programs;
    }

    public function setPrograms(?Program $programs): self
    {
        $this->programs = $programs;

        return $this;
    }

    /**
     * @return Collection|Episodes[]
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episodes $episodes): self
    {
        if (!$this->episodes->contains($episodes)) {
            $this->episodes[] = $episodes;
            $episodes->setEpisodes($this);
        }

        return $this;
    }

    public function removeEpisode(Episodes $episodes): self
    {
        if ($this->episodes->contains($episodes)) {
            $this->episodes->removeElement($episodes);
            // set the owning side to null (unless already changed)
            if ($episodes->getEpisodes() === $this) {
                $episodes->setEpisodes(null);
            }
        }

        return $this;
    }
}
