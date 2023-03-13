<?php

namespace App\Entity;

use App\Repository\ConcertHallRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcertHallRepository::class)]
class ConcertHall
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'concertHall', targetEntity: Concert::class)]
    private Collection $concerts;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 5000)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $seatCapacity = null;

    #[ORM\Column]
    private ?int $standingCapacity = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $renovationStartDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $renovationEndDate = null;

    public function __construct()
    {
        $this->Concerts = new ArrayCollection();
        $this->concerts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Concert>
     */
    public function getConcerts(): Collection
    {
        return $this->Concerts;
    }

    public function addConcert(Concert $concert): self
    {
        if (!$this->Concerts->contains($concert)) {
            $this->Concerts->add($concert);
            $concert->setConcertHall($this);
        }

        return $this;
    }

    public function removeConcert(Concert $concert): self
    {
        if ($this->Concerts->removeElement($concert)) {
            // set the owning side to null (unless already changed)
            if ($concert->getConcertHall() === $this) {
                $concert->setConcertHall(null);
            }
        }

        return $this;
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

    public function getSeatCapacity(): ?int
    {
        return $this->seatCapacity;
    }

    public function setSeatCapacity(int $seatCapacity): self
    {
        $this->seatCapacity = $seatCapacity;

        return $this;
    }

    public function getStandingCapacity(): ?int
    {
        return $this->standingCapacity;
    }

    public function setStandingCapacity(int $standingCapacity): self
    {
        $this->standingCapacity = $standingCapacity;
        return $this;
    }

    public function getRenovationStartDate(): ?\DateTimeInterface
    {
        return $this->renovationStartDate;
    }

    public function setRenovationStartDate(?\DateTimeInterface $renovationStartDate): self
    {
        $this->renovationStartDate = $renovationStartDate;

        return $this;
    }

    public function getRenovationEndDate(): ?\DateTimeInterface
    {
        return $this->renovationEndDate;
    }

    public function setRenovationEndDate(?\DateTimeInterface $renovationEndDate): self
    {
        $this->renovationEndDate = $renovationEndDate;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }


}
