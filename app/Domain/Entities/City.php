<?php

namespace App\Domain\Entities;

class City
{
    private ?int $id;
    private int $ibgeId;
    private string $ibgeName;

    public function __construct(?int $id, int $ibgeId, string $ibgeName)
    {
        $this->id = $id;
        $this->ibgeId = $ibgeId;
        $this->ibgeName = $ibgeName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIbgeId(): int
    {
        return $this->ibgeId;
    }

    public function setIbgeId(int $ibgeId): void
    {
        $this->ibgeId = $ibgeId;
    }

    public function getIbgeName(): string
    {
        return $this->ibgeName;
    }

    public function setIbgeName(string $ibgeName): void
    {
        $this->ibgeName = $ibgeName;
    }
}