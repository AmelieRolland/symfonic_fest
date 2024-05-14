<?php

namespace App\Entity;

use App\Repository\DaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DaysRepository::class)]
class Days
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $day = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgFileName = null;

    /**
     * @var Collection<int, ProgDay>
     */
    #[ORM\OneToMany(targetEntity: ProgDay::class, mappedBy: 'days')]
    private Collection $progDays;

    public function __construct()
    {
        $this->progDays = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getImgFileName(): ?string
    {
        return $this->imgFileName;
    }

    public function setImgFileName(?string $imgFileName): static
    {
        $this->imgFileName = $imgFileName;

        return $this;
    }

    /**
     * @return Collection<int, ProgDay>
     */
    public function getProgDays(): Collection
    {
        return $this->progDays;
    }

    public function addProgDay(ProgDay $progDay): static
    {
        if (!$this->progDays->contains($progDay)) {
            $this->progDays->add($progDay);
            $progDay->setDays($this);
        }

        return $this;
    }

    public function removeProgDay(ProgDay $progDay): static
    {
        if ($this->progDays->removeElement($progDay)) {
            // set the owning side to null (unless already changed)
            if ($progDay->getDays() === $this) {
                $progDay->setDays(null);
            }
        }

        return $this;
    }
}
