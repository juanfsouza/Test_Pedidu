<?php

namespace App\Application\UseCases\Product;

use App\Domain\Repositories\ProductRepositoryInterface;

class ListProductsUseCase
{
    private ProductRepositoryInterface $repo;

    public function __construct(ProductRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /*
        Busca todos os produtos ex ($repository->findAll())
        Retorna a lista de produtos
    */

    public function execute(): array
    {
        return $this->repo->findAll();
    }
}