<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Entities\Product;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\ProductModel;

class EloquentProductRepository implements ProductRepositoryInterface
{
    // Salva ou atualiza o produto
    public function save(Product $product): Product
    {
        $model = $product->getId()
            ? ProductModel::find($product->getId())
            : new ProductModel();

        $model->name = $product->getName();
        $model->category = $product->getCategory();
        $model->status = $product->getStatus();
        $model->quantity = $product->getQuantity();
        $model->save();

        // Atualiza o ID na entidade do domínio
        $product->setId($model->id);

        return $product;
    }

    // Retorna todos os produtos
    public function findAll(): array
    {
        $models = ProductModel::all();
        return $models->map(function ($model) {
            return new Product(
                $model->id,
                $model->name,
                $model->category,
                $model->status,
                $model->quantity
            );
        })->toArray();
    }

    // Retorna um produto pelo id
    public function findById(int $id): ?Product
    {
        $model = ProductModel::find($id);

        if (!$model) return null;

        return new Product(
            $model->id,
            $model->name,
            $model->category,
            $model->status,
            $model->quantity
        );
    }

    // Deleta um produto
    public function delete(Product $product): void
    {
        ProductModel::destroy($product->getId());
    }

    // Verifica se um produto existe
    public function exists(Product $product): bool
    {
        if ($product->getId()) {
            return ProductModel::where('id', $product->getId())->exists();
        }

        return ProductModel::where('name', $product->getName())
            ->where('category', $product->getCategory())
            ->exists();
    }
}
