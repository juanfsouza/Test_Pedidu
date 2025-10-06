<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\City;

interface CityRepositoryInterface
{
    public function save(City $city): City;
    public function exists(City $city): bool;
    public function findAll(): array;
}