<?php

namespace App\Entity;

use App\Repository\SceneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SceneRepository::class)]
class Scene
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $sceneName = null;

    /**
     * @var Collection<int, ProgDay>
     */
    #[ORM\ManyToMany(targetEntity: ProgDay::class, mappedBy: 'scene')]
    private Collection $progDays;

    public function __construct()
    {
        $this->progDays = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSceneName(): ?string
    {
        return $this->sceneName;
    }

    public function setSceneName(string $sceneName): static
    {
        $this->sceneName = $sceneName;

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
            $progDay->addScene($this);
        }

        return $this;
    }

    public function removeProgDay(ProgDay $progDay): static
    {
        if ($this->progDays->removeElement($progDay)) {
            $progDay->removeScene($this);
        }

        return $this;
    }
}
