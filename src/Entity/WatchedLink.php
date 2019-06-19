<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WatchedLinkRepository")
 */
class WatchedLink
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $srcUrl;

    /**
     * @ORM\Column(type="text")
     */
    private $detsUrl;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visit", mappedBy="WatchedLink")
     */
    private $visits;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $newUri;

    public function __construct()
    {
        $this->visits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSrcUrl(): ?string
    {
        return $this->srcUrl;
    }

    public function setSrcUrl(string $srcUrl): self
    {
        $this->srcUrl = $srcUrl;

        return $this;
    }

    public function getDetsUrl(): ?string
    {
        return $this->detsUrl;
    }

    public function setDetsUrl(string $detsUrl): self
    {
        $this->detsUrl = $detsUrl;

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
     * @return Collection|Visit[]
     */
    public function getVisits(): Collection
    {
        return $this->visits;
    }

    public function addVisit(Visit $visit): self
    {
        if (!$this->visits->contains($visit)) {
            $this->visits[] = $visit;
            $visit->setWatchedLink($this);
        }

        return $this;
    }

    public function removeVisit(Visit $visit): self
    {
        if ($this->visits->contains($visit)) {
            $this->visits->removeElement($visit);
            // set the owning side to null (unless already changed)
            if ($visit->getWatchedLink() === $this) {
                $visit->setWatchedLink(null);
            }
        }

        return $this;
    }

    public function getNewUri(): ?string
    {
        return $this->newUri;
    }

    public function setNewUri(string $newUri): self
    {
        $this->newUri = $newUri;

        return $this;
    }
}
