<?php

namespace App\Entity;

use App\Repository\ConcertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcertRepository::class)]
class Concert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 5000)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToMany(targetEntity: Artist::class, inversedBy: 'concertsPerformed')]
    private Collection $artistsPerformers;

    #[ORM\OneToMany(mappedBy: 'concert', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\ManyToOne(inversedBy: 'concerts')]
    private ?ConcertHall $concertHall = null;

    #[ORM\OneToMany(mappedBy: 'concert', targetEntity: Ticket::class)]
    private Collection $soldTickets;

    #[ORM\ManyToMany(targetEntity: Photo::class, mappedBy: 'concerts')]
    private Collection $photos;



    public function __construct()
    {
        $this->artistsPerformers = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->soldTickets = new ArrayCollection();
        $this->photos = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtistsPerformers(): Collection
    {
        return $this->artistsPerformers;
    }

    public function addArtistsPerformer(Artist $artistsPerformer): self
    {
        if (!$this->artistsPerformers->contains($artistsPerformer)) {
            $this->artistsPerformers->add($artistsPerformer);
        }

        return $this;
    }

    public function removeArtistsPerformer(Artist $artistsPerformer): self
    {
        $this->artistsPerformers->removeElement($artistsPerformer);

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setConcert($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getConcert() === $this) {
                $comment->setConcert(null);
            }
        }

        return $this;
    }

    public function getConcertHall(): ?ConcertHall
    {
        return $this->concertHall;
    }

    public function setConcertHall(?ConcertHall $concertHall): self
    {
        $this->concertHall = $concertHall;

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getSoldTickets(): Collection
    {
        return $this->soldTickets;
    }

    public function addSoldTicket(Ticket $soldTicket): self
    {
        if (!$this->soldTickets->contains($soldTicket)) {
            $this->soldTickets->add($soldTicket);
            $soldTicket->setConcert($this);
        }

        return $this;
    }

    public function removeSoldTicket(Ticket $soldTicket): self
    {
        if ($this->soldTickets->removeElement($soldTicket)) {
            // set the owning side to null (unless already changed)
            if ($soldTicket->getConcert() === $this) {
                $soldTicket->setConcert(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->addConcert($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            $photo->removeConcert($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

}
