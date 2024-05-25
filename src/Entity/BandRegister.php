<?php

namespace App\Entity;

use App\Repository\BandRegisterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BandRegisterRepository::class)]
class BandRegister
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $band_name = null;

    #[ORM\Column]
    private ?int $creation_year = null;

    #[ORM\Column(length: 255)]
    private ?string $imgFileName = null;

    #[ORM\ManyToOne(inversedBy: 'bandRegisters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MusicGenre $musicGenreId = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $country = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var Collection<int, BandImages>
     */
    #[ORM\OneToMany(targetEntity: BandImages::class, mappedBy: 'band')]
    private Collection $bandImages;

    public function __construct()
    {
        $this->bandImages = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBandName(): ?string
    {
        return $this->band_name;
    }

    public function setBandName(string $band_name): static
    {
        $this->band_name = $band_name;

        return $this;
    }

    public function getCreationYear(): ?int
    {
        return $this->creation_year;
    }

    public function setCreationYear(int $creation_year): static
    {
        $this->creation_year = $creation_year;

        return $this;
    }

    public function getImgFileName(): ?string
    {
        return $this->imgFileName;
    }

    public function setImgFileName(string $imgFileName): static
    {
        $this->imgFileName = $imgFileName;

        return $this;
    }

    public function getMusicGenreId(): ?MusicGenre
    {
        return $this->musicGenreId;
    }

    public function setMusicGenreId(?MusicGenre $musicGenreId): static
    {
        $this->musicGenreId = $musicGenreId;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, BandImages>
     */
    public function getBandImages(): Collection
    {
        return $this->bandImages;
    }

    public function addBandImage(BandImages $bandImage): static
    {
        if (!$this->bandImages->contains($bandImage)) {
            $this->bandImages->add($bandImage);
            $bandImage->setBand($this);
        }

        return $this;
    }

    public function removeBandImage(BandImages $bandImage): static
    {
        if ($this->bandImages->removeElement($bandImage)) {
            if ($bandImage->getBand() === $this) {
                $bandImage->setBand(null);
            }
        }

        return $this;
    }



    // public function removeProgDay(ProgDay $progDay): self
    // {
    //     if ($this->progDay->removeElement($progDay)) {
    //         if ($progDay->getBandRegister() === $this) {
    //             $progDay->setBandRegister(null);
    //         }
    //     }

    //     return $this;
    // }
    

}
