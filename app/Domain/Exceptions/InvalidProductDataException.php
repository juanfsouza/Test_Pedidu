<?php

namespace App\Domain\Exceptions;

use Exception;

/**
 * Exception thrown when product data is invalid
 */
class InvalidProductDataException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message, 422);
    }
}
