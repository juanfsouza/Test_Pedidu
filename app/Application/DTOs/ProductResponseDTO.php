<?php

namespace App\Application\DTOs;

class ProductResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $category,
        public readonly string $status,
        public readonly int $quantity,
        public readonly ?string $createdAt,
        public readonly ?string $updatedAt
    ) {}

    public static function fromProductDTO(\App\Application\DTOs\ProductDTO $productDTO): self
    {
        return new self(
            id: $productDTO->id,
            name: $productDTO->name,
            category: $productDTO->category,
            status: $productDTO->status,
            quantity: $productDTO->quantity,
            createdAt: $productDTO->createdAt,
            updatedAt: $productDTO->updatedAt
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'status' => $this->status,
            'quantity' => $this->quantity,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt
        ];
    }
}
