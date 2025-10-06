<?php

namespace App\Domain\Exceptions;

use Exception;

/**
 * Exception thrown when a city is not found
 */
class CityNotFoundException extends Exception
{
    public function __construct(int $cityId)
    {
        parent::__construct("Cidade com ID {$cityId} não encontrada", 404);
    }
}
