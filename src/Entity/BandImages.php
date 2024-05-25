<?php

namespace App\Entity;

use App\Repository\BandImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BandImagesRepository::class)]
class BandImages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $img_name = null;

    #[ORM\ManyToOne(inversedBy: 'bandImages')]
    private ?BandRegister $band = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImgName(): ?string
    {
        return $this->img_name;
    }

    public function setImgName(string $img_name): static
    {
        $this->img_name = $img_name;

        return $this;
    }

    public function getBand(): ?BandRegister
    {
        return $this->band;
    }

    public function setBand(?BandRegister $band): static
    {
        $this->band = $band;

        return $this;
    }
}
