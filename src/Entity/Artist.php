<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 5000, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: MusicStyle::class, inversedBy: 'artists')]
    private Collection $musicStyles;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'artistsLiked')]
    private Collection $usersLikes;

    #[ORM\ManyToMany(targetEntity: Concert::class, mappedBy: 'artistsPerformers')]
    private Collection $concertsPerformed;

    #[ORM\ManyToMany(targetEntity: Photo::class, mappedBy: 'artists')]
    private Collection $photos;

    public function __construct()
    {
        $this->musicStyles = new ArrayCollection();
        $this->usersLikes = new ArrayCollection();
        $this->concertsPerformed = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, MusicStyle>
     */
    public function getMusicStyles(): Collection
    {
        return $this->musicStyles;
    }

    public function addMusicStyle(MusicStyle $musicStyle): self
    {
        if (!$this->musicStyles->contains($musicStyle)) {
            $this->musicStyles->add($musicStyle);
        }

        return $this;
    }

    public function removeMusicStyle(MusicStyle $musicStyle): self
    {
        $this->musicStyles->removeElement($musicStyle);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersLikes(): Collection
    {
        return $this->usersLikes;
    }

    public function addUsersLike(User $usersLike): self
    {
        if (!$this->usersLikes->contains($usersLike)) {
            $this->usersLikes->add($usersLike);
        }

        return $this;
    }

    public function removeUsersLike(User $usersLike): self
    {
        $this->usersLikes->removeElement($usersLike);

        return $this;
    }

    /**
     * @return Collection<int, Concert>
     */
    public function getConcertsPerformed(): Collection
    {
        return $this->concertsPerformed;
    }

    public function addConcertsPerformed(Concert $concertsPerformed): self
    {
        if (!$this->concertsPerformed->contains($concertsPerformed)) {
            $this->concertsPerformed->add($concertsPerformed);
            $concertsPerformed->addArtistsPerformer($this);
        }

        return $this;
    }

    public function removeConcertsPerformed(Concert $concertsPerformed): self
    {
        if ($this->concertsPerformed->removeElement($concertsPerformed)) {
            $concertsPerformed->removeArtistsPerformer($this);
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
            $photo->addArtist($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            $photo->removeArtist($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }


}
