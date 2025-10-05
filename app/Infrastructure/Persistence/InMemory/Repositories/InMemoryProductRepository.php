<?php

namespace App\Infrastructure\Persistence\InMemory\Repositories;
use App\Domain\Entities\Product;
use App\Domain\Repositories\ProductRepositoryInterface;

class InMemoryProductRepository implements ProductRepositoryInterface
{
    private array $products = [];

    public function save(Product $product): Product 
    {
        $this->products[$product->getId()] = $product;
        return $product;
    }

    public function findAll(): array
    {
        return array_values($this->products);
    }

    public function findById(int $id): ?Product 
    {
        return $this->products[$id] ?? null;
    }

    public function delete(Product $product): void
    {
        unset($this->products[$product->getId()]);
    }

    public function exists(Product $product): bool
    {
        return isset($this->products[$product->getId()]);
    }
}