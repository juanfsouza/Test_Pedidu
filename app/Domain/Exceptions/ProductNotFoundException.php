<?php

namespace App\Domain\Exceptions;

use Exception;

/**
 * Exception thrown when a product is not found
 */
class ProductNotFoundException extends Exception
{
    public function __construct(int $productId)
    {
        parent::__construct("Produto com ID {$productId} não encontrado", 404);
    }
}
