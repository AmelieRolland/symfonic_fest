<?php

namespace App\Entity;

use App\Repository\ProgDayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Scene>
     */
    #[ORM\ManyToMany(targetEntity: Scene::class, inversedBy: 'progDays')]
    private Collection $scene;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hour = null;

    /**
     * @var Collection<int, BandRegister>
     */
    #[ORM\OneToMany(targetEntity: BandRegister::class, mappedBy: 'progDay')]
    private Collection $bandRegister;

    public function __construct()
    {
        $this->scene = new ArrayCollection();
        $this->bandRegister = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Scene>
     */
    public function getScene(): Collection
    {
        return $this->scene;
    }

    public function addScene(Scene $scene): static
    {
        if (!$this->scene->contains($scene)) {
            $this->scene->add($scene);
        }

        return $this;
    }

    public function removeScene(Scene $scene): static
    {
        $this->scene->removeElement($scene);

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

    /**
     * @return Collection<int, BandRegister>
     */
    public function getBandRegister(): Collection
    {
        return $this->bandRegister;
    }

    public function addBandRegister(BandRegister $bandRegister): static
    {
        if (!$this->bandRegister->contains($bandRegister)) {
            $this->bandRegister->add($bandRegister);
            $bandRegister->setProgDay($this);
        }

        return $this;
    }

    public function removeBandRegister(BandRegister $bandRegister): static
    {
        if ($this->bandRegister->removeElement($bandRegister)) {
            // set the owning side to null (unless already changed)
            if ($bandRegister->getProgDay() === $this) {
                $bandRegister->setProgDay(null);
            }
        }

        return $this;
    }
}
