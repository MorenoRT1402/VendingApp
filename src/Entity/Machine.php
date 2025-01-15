<?php

namespace App\Entity;

use App\Enum\MachineStatus;
use App\Repository\MachineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MachineRepository::class)]
class Machine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    /**
     * @var Collection<int, Stock>
     */
    #[ORM\OneToMany(targetEntity: Stock::class, mappedBy: 'machine', orphanRemoval: true)]
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
