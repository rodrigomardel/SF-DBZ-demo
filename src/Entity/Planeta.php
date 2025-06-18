<?php

namespace App\Entity;

use App\Repository\PlanetaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanetaRepository::class)]
class Planeta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDestroyed = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $deletedAt = null;

    /**
     * @var Collection<int, Personaje>
     */
    #[ORM\OneToMany(targetEntity: Personaje::class, mappedBy: 'planeta')]
    private Collection $character_id;

    public function __construct()
    {
        $this->character_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isDestroyed(): ?bool
    {
        return $this->isDestroyed;
    }

    public function setIsDestroyed(?bool $isDestroyed): static
    {
        $this->isDestroyed = $isDestroyed;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDeletedAt(): ?\DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTime $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return Collection<int, Personaje>
     */
    public function getCharacterId(): Collection
    {
        return $this->character_id;
    }

    public function addCharacterId(Personaje $characterId): static
    {
        if (!$this->character_id->contains($characterId)) {
            $this->character_id->add($characterId);
            $characterId->setPlaneta($this);
        }

        return $this;
    }

    public function removeCharacterId(Personaje $characterId): static
    {
        if ($this->character_id->removeElement($characterId)) {
            // set the owning side to null (unless already changed)
            if ($characterId->getPlaneta() === $this) {
                $characterId->setPlaneta(null);
            }
        }

        return $this;
    }

}
