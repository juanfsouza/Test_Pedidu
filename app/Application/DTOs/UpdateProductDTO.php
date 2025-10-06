<?php

namespace App\Application\DTOs;

class UpdateProductDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name = null,
        public readonly ?string $category = null,
        public readonly ?string $status = null,
        public readonly ?int $quantity = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'] ?? null,
            category: $data['category'] ?? null,
            status: $data['status'] ?? null,
            quantity: $data['quantity'] ?? null
        );
    }

    public function toArray(): array
    {
        $data = ['id' => $this->id];
        
        if ($this->name !== null) $data['name'] = $this->name;
        if ($this->category !== null) $data['category'] = $this->category;
        if ($this->status !== null) $data['status'] = $this->status;
        if ($this->quantity !== null) $data['quantity'] = $this->quantity;
        
        return $data;
    }
}
