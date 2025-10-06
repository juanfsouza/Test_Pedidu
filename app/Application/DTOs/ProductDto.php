<?php

namespace App\Application\DTOs;

class ProductDTO
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $category,
        public string $status,
        public int $quantity
    ) {}
}
