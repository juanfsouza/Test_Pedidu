<?php

namespace App\Application\DTOs;

class CityResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $ibgeId,
        public readonly string $ibgeName,
        public readonly string $createdAt,
        public readonly string $updatedAt
    ) {}

    public static function fromCityDTO(CityDTO $cityDTO): self
    {
        return new self(
            id: $cityDTO->id,
            ibgeId: $cityDTO->ibgeId,
            ibgeName: $cityDTO->ibgeName,
            createdAt: $cityDTO->createdAt,
            updatedAt: $cityDTO->updatedAt
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
