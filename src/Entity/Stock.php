<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StockRepository::class)]
// #[ApiResource(
//     security: "is_granted('ROLE_ADMIN')",
//     normalizationContext: ['groups' => ['stock:read']]
//     )]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['stock:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'inventory', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['stock:read'])]
    private ?Machine $machine = null;

    #[ORM\ManyToOne(inversedBy: 'inventory', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['stock:read'])]
    private ?Product $product = null;

    #[ORM\Column]
    #[Groups(['stock:read', 'stock:write'])]
    private ?int $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMachine(): ?Machine
    {
        return $this->machine;
    }

    public function setMachine(?Machine $machine): static
    {
        $this->machine = $machine;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}
