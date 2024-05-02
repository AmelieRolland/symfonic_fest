<?php

namespace App\Entity;

use App\Repository\SceneRepository;
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
}
