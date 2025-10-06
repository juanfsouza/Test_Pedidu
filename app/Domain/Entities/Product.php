<?php

namespace App\Domain\Entities;

use DateTime;

/**
 * Product Entity
 * 
 * Represents a product in the domain with business rules and validation.
 * This entity encapsulates all product-related business logic and ensures
 * data integrity through validation in setters.
 * 
 * @package App\Domain\Entities
 */
class Product
{
    private int $id;
    private string $name;
    private string $category;
    private string $status;
    private int $quantity;
    private ?DateTime $createdAt = null;
    private ?DateTime $updatedAt = null;
    private ?DateTime $deletedAt = null;

    /**
     * Product constructor
     * 
     * @param int $id Product ID
     * @param string $name Product name (max 255 chars)
     * @param string $category Product category (max 255 chars)
     * @param string $status Product status (ACTIVE or INACTIVE)
     * @param int $quantity Product quantity (must be >= 0)
     * @throws \InvalidArgumentException If validation fails
     */
    public function __construct(int $id, string $name, string $category, string $status, int $quantity)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setCategory($category);
        $this->setStatus($status);
        $this->setQuantity($quantity);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        if (empty(trim($name))) {
            throw new \InvalidArgumentException('O nome do produto não pode estar vazio');
        }
        if (strlen($name) > 255) {
            throw new \InvalidArgumentException('O nome do produto não pode ter mais de 255 caracteres');
        }
        $this->name = trim($name);
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        if (empty(trim($category))) {
            throw new \InvalidArgumentException('A categoria do produto não pode estar vazia');
        }
        if (strlen($category) > 255) {
            throw new \InvalidArgumentException('A categoria do produto não pode ter mais de 255 caracteres');
        }
        $this->category = trim($category);
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $validStatuses = ['ACTIVE', 'INACTIVE'];
        if (!in_array($status, $validStatuses)) {
            throw new \InvalidArgumentException('Status deve ser ACTIVE ou INACTIVE');
        }
        $this->status = $status;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        if ($quantity < 0) {
            throw new \InvalidArgumentException('A quantidade não pode ser negativa');
        }
        $this->quantity = $quantity;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

}
