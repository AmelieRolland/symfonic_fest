<?php

namespace App\Entity;

use App\Repository\ProgDayRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgDayRepository::class)]
class ProgDay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'progDays')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Days $days = null;


    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hour = null;

    

    #[ORM\ManyToOne(inversedBy: 'progDay')]
    private ?Scene $scene = null;

    #[ORM\ManyToOne(inversedBy: 'progDays')]
    private ?BandRegister $bandRegister = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDays(): ?Days
    {
        return $this->days;
    }

    public function setDays(?Days $days): static
    {
        $this->days = $days;

        return $this;
    }


    public function getHour(): ?\DateTimeInterface
    {
        return $this->hour;
    }

    public function setHour(\DateTimeInterface $hour): static
    {
        $this->hour = $hour;

        return $this;
    }


    public function getScene(): ?Scene
    {
        return $this->scene;
    }

    public function setScene(?Scene $scene): static
    {
        $this->scene = $scene;

        return $this;
    }

    public function getBandRegister(): ?BandRegister
    {
        return $this->bandRegister;
    }

    public function setBandRegister(?BandRegister $bandRegister): static
    {
        $this->bandRegister = $bandRegister;

        return $this;
    }
}
