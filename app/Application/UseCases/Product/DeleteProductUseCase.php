<?php

namespace App\Application\UseCases\Product;

use App\Domain\Entities\Product;
use App\Domain\Repositories\ProductRepositoryInterface;

class DeleteProductUseCase
{
    private ProductRepositoryInterface $repo;

    public function __construct(ProductRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /*
        Recebe ID do produto
        Busca produto existente ex ($repository->findById($id))
        Deleta produto ex ($repository->delete($product))
        Retorna a entidade deletada
    */

    public function execute(int $id): Product
    {
        $product = $this->repo->findById($id);
        if (!$product) {
            throw new \InvalidArgumentException('Produto não encontrado');
        }
        $this->repo->delete($product);
        return $product;
    }
}