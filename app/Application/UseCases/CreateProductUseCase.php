<?php

namespace App\Application\UseCases;

use App\Domain\Entities\Product;
use App\Domain\Repositories\ProductRepositoryInterface;

class CreateProductUseCase
{   
    private ProductRepositoryInterface $repo;

    public function __construct(ProductRepositoryInterface $repo) 
    {
        $this->repo = $repo;
    }

    /*
        Recebe dados do produto (name, category, status, quantity)
        Cria uma instância de Product
        Valida regras (ex: quantity ≥ 0, status válido)
        Chama $repository->save($product)
        Retorna a entidade criada
    */
    public function createProduct(array $data): Product
    {
        $product = new Product(
            $data?['id'], 
            $data['name'], 
            $data['category'], 
            $data['status'], 
            $data['quantity']
        );

        $this->validate($product);

        return $this->repo->save($product);
    }

    public function validate(Product $product): void
    {
        if ($product->getQuantity() < 0) {
            throw new \InvalidArgumentException('A quantidade não pode ser negativa');
        }
    }

}