<?php

namespace App\Entity;

use App\Repository\BandRegisterRepository;
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
}
