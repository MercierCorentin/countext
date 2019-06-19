<?php

namespace App\Entity;

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
}
