<?php

namespace App\Application\DTOs;

class CityDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $ibgeId,
        public readonly string $ibgeName,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            ibgeId: $data['ibge_id'],
            ibgeName: $data['ibge_name'],
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null
        );
    }

    public static function fromIbgeApi(array $data): self
    {
        return new self(
            id: null,
            ibgeId: $data['id'],
            ibgeName: $data['nome']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'ibge_id' => $this->ibgeId,
            'ibge_name' => $this->ibgeName,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt
        ];
    }
}
