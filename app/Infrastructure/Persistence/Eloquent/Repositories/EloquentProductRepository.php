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
        
        // Mapeia as datas de volta para a entidade
        $product->setCreatedAt($model->created_at);
        $product->setUpdatedAt($model->updated_at);

        return $product;
    }

    // Retorna todos os produtos
    public function findAll(): array
    {
        $models = ProductModel::all();
        return $models->map(function ($model) {
            $product = new Product(
                $model->id,
                $model->name,
                $model->category,
                $model->status,
                $model->quantity
            );
            $product->setCreatedAt($model->created_at);
            $product->setUpdatedAt($model->updated_at);
            return $product;
        })->toArray();
    }

    // Retorna um produto pelo id
    public function findById(int $id): ?Product
    {
        $model = ProductModel::find($id);

        if (!$model) return null;

        $product = new Product(
            $model->id,
            $model->name,
            $model->category,
            $model->status,
            $model->quantity
        );
        
        $product->setCreatedAt($model->created_at);
        $product->setUpdatedAt($model->updated_at);
        
        return $product;
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
