<?php

namespace App\Application\DTOs;

class CreateProductDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $category,
        public readonly string $status,
        public readonly int $quantity
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            category: $data['category'],
            status: $data['status'],
            quantity: $data['quantity']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'category' => $this->category,
            'status' => $this->status,
            'quantity' => $this->quantity
        ];
    }
}
