<?php

namespace App\Application\UseCases\Product;

use App\Domain\Entities\Product;
use App\Domain\Repositories\ProductRepositoryInterface;

class UpdateProductUseCase
{
    private ProductRepositoryInterface $repo;

    public function __construct(ProductRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /*
        Recebe ID e dados do produto
        Busca produto existente ex ($repository->findById($id))
        Atualiza campos e valida
        Chama ex $repository->save($product)
        Retorna a entidade atualizada
        Está ótimo, a estrutura é perfeita — mas aqui vão observações:
    */
    
    public function execute(int $id, array $data): Product
    {
        $product = $this->repo->findById($id);
        if (!$product) {
            throw new \InvalidArgumentException('Produto não encontrado');
        }
        if (isset($data['name'])) {
            $product->setName($data['name']);
        }
        if (isset($data['category'])) {
            $product->setCategory($data['category']);
        }
        if (isset($data['status'])) {
            $product->setStatus($data['status']);
        }
        if (isset($data['quantity'])) {
            $product->setQuantity($data['quantity']);
        }   
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