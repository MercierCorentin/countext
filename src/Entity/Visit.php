<?php

namespace App\Entity;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisitRepository")
 */
class Visit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\WatchedLink", inversedBy="visits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $watchedLink;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getwatchedLink(): ?WatchedLink
    {
        return $this->watchedLink;
    }

    public function setwatchedLink(?WatchedLink $watchedLink): self
    {
        $this->watchedLink = $watchedLink;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(): self
    {
        $time = new DateTime(date("Y-m-d H:i:s"));

        $this->time = $time;

        return $this;
    }
}
