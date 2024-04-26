<?php

namespace App\Entity;

use App\Repository\MusicGenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusicGenreRepository::class)]
class MusicGenre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genreName = null;

    /**
     * @var Collection<int, BandRegister>
     */
    #[ORM\OneToMany(targetEntity: BandRegister::class, mappedBy: 'musicGenreId')]
    private Collection $bandRegisters;

    public function __construct()
    {
        $this->bandRegisters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenreName(): ?string
    {
        return $this->genreName;
    }

    public function setGenreName(string $genreName): static
    {
        $this->genreName = $genreName;

        return $this;
    }

    /**
     * @return Collection<int, BandRegister>
     */
    public function getBandRegisters(): Collection
    {
        return $this->bandRegisters;
    }

    public function addBandRegister(BandRegister $bandRegister): static
    {
        if (!$this->bandRegisters->contains($bandRegister)) {
            $this->bandRegisters->add($bandRegister);
            $bandRegister->setMusicGenreId($this);
        }

        return $this;
    }

    public function removeBandRegister(BandRegister $bandRegister): static
    {
        if ($this->bandRegisters->removeElement($bandRegister)) {
            // set the owning side to null (unless already changed)
            if ($bandRegister->getMusicGenreId() === $this) {
                $bandRegister->setMusicGenreId(null);
            }
        }

        return $this;
    }
}
