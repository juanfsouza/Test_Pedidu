<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\ProductRepositoryInterface;
use App\Domain\Entities\Product;

class GetProductUseCase
{
    private ProductRepositoryInterface $repo;

    public function __construct(ProductRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /* 
     Chama ex $repository->findById($id)
     Retorna produto ou null
    */

    public function execute(int $id): ?Product
    {
        return $this->repo->findById($id);
    }

}