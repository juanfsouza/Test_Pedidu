<?php

namespace App\Application\DTOs;

class ProductDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $category,
        public readonly string $status,
        public readonly int $quantity,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            category: $data['category'],
            status: $data['status'],
            quantity: $data['quantity'],
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null
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
