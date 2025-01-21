<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Enum\MachineStatus;
use App\Repository\MachineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MachineRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
    ],
    normalizationContext: ['groups' => ['machine:read']],
    denormalizationContext: ['groups' => ['machine:write']],
    security: "is_granted('ROLE_ADMIN')"
)]class Machine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['machine:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['machine:read', 'machine:write'])]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    #[Groups(['machine:read', 'machine:write'])]
    private ?string $model = null;

    /**
     * @var Collection<int, Stock>
     */
    #[ORM\OneToMany(targetEntity: Stock::class, mappedBy: 'machine', cascade: ['persist'], orphanRemoval: true)]
    private Collection $inventory;

    #[ORM\Column(type: Types::STRING, enumType: MachineStatus::class)]
    private ?MachineStatus $status = null;

    public function __construct()
    {
        $this->inventory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getInventory(): Collection
    {
        return $this->inventory;
    }

    public function addInventory(Stock $inventory): static
    {
        if (!$this->inventory->contains($inventory)) {
            $this->inventory->add($inventory);
            $inventory->setMachine($this);
        }

        return $this;
    }

    public function removeInventory(Stock $inventory): static
    {
        if ($this->inventory->removeElement($inventory)) {
            // set the owning side to null (unless already changed)
            if ($inventory->getMachine() === $this) {
                $inventory->setMachine(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?MachineStatus
    {
        return $this->status;
    }

    public function setStatus(?MachineStatus $status): static
    {
        $this->status = $status;

        return $this;
    }
}
