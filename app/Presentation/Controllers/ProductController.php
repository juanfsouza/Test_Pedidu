<?php

namespace App\Presentation\Controllers;

use App\Application\UseCases\Product\GetProductUseCase;
use App\Application\UseCases\Product\ListProductsUseCase;
use App\Application\UseCases\Product\CreateProductUseCase;
use App\Application\UseCases\Product\UpdateProductUseCase;
use App\Application\UseCases\Product\DeleteProductUseCase;
use App\Application\DTOs\CreateProductDTO;
use App\Application\DTOs\UpdateProductDTO;
use App\Application\DTOs\ProductDTO;
use App\Application\DTOs\ProductResponseDTO;
use App\Domain\Exceptions\ProductNotFoundException;
use App\Domain\Exceptions\InvalidProductDataException;
use Illuminate\Http\Request;
class ProductController
{
    private GetProductUseCase $getProductUseCase;   
    private ListProductsUseCase $listProductsUseCase;
    private CreateProductUseCase $createProductUseCase;
    private UpdateProductUseCase $updateProductUseCase;
    private DeleteProductUseCase $deleteProductUseCase;

    public function __construct(
        GetProductUseCase $getProductUseCase, 
        ListProductsUseCase $listProductsUseCase, 
        CreateProductUseCase $createProductUseCase, 
        UpdateProductUseCase $updateProductUseCase, 
        DeleteProductUseCase $deleteProductUseCase
    )
    {
        $this->getProductUseCase = $getProductUseCase;
        $this->listProductsUseCase = $listProductsUseCase;
        $this->createProductUseCase = $createProductUseCase;
        $this->updateProductUseCase = $updateProductUseCase;
        $this->deleteProductUseCase = $deleteProductUseCase;
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'status' => 'required|string|in:ACTIVE,INACTIVE',
                'quantity' => 'required|integer|min:0',
            ]);
            
            $createProductDTO = CreateProductDTO::fromArray($request->all());
            $product = $this->createProductUseCase->execute($createProductDTO->toArray());
            
            $productDTO = ProductDTO::fromArray([
                'id' => $product->getId(),
                'name' => $product->getName(),
                'category' => $product->getCategory(),
                'status' => $product->getStatus(),
                'quantity' => $product->getQuantity(),
                'created_at' => $product->getCreatedAt()?->format('Y-m-d H:i:s'),
                'updated_at' => $product->getUpdatedAt()?->format('Y-m-d H:i:s')
            ]);
            $responseDTO = ProductResponseDTO::fromProductDTO($productDTO);
            return response()->json($responseDTO->toArray(), 201);
            
        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'message' => 'Dados inválidos',
                'error' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro interno do servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function list()
    {
        $products = $this->listProductsUseCase->execute();
        $responseDTOs = array_map(function($product) {
            $productDTO = ProductDTO::fromArray([
                'id' => $product->getId(),
                'name' => $product->getName(),
                'category' => $product->getCategory(),
                'status' => $product->getStatus(),
                'quantity' => $product->getQuantity(),
                'created_at' => $product->getCreatedAt()?->format('Y-m-d H:i:s'),
                'updated_at' => $product->getUpdatedAt()?->format('Y-m-d H:i:s')
            ]);
            return ProductResponseDTO::fromProductDTO($productDTO)->toArray();
        }, $products);
        
        return response()->json($responseDTOs);
    }

    public function get(int $id)
    {
        try {
            $product = $this->getProductUseCase->execute($id);
            if (!$product) {
                throw new ProductNotFoundException($id);
            }
            
            $productDTO = ProductDTO::fromArray([
                'id' => $product->getId(),
                'name' => $product->getName(),
                'category' => $product->getCategory(),
                'status' => $product->getStatus(),
                'quantity' => $product->getQuantity(),
                'created_at' => $product->getCreatedAt()?->format('Y-m-d H:i:s'),
                'updated_at' => $product->getUpdatedAt()?->format('Y-m-d H:i:s')
            ]);
            $responseDTO = ProductResponseDTO::fromProductDTO($productDTO);
            return response()->json($responseDTO->toArray());
            
        } catch (ProductNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro interno do servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(int $id, Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
            'category' => 'string|max:255',
            'status' => 'string|max:255',
            'quantity' => 'integer',
        ]);

        $updateData = array_merge(['id' => $id], $request->all());
        $updateProductDTO = UpdateProductDTO::fromArray($updateData);
        $product = $this->updateProductUseCase->execute($id, $updateProductDTO->toArray());
        
        $productDTO = ProductDTO::fromArray([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'category' => $product->getCategory(),
            'status' => $product->getStatus(),
            'quantity' => $product->getQuantity(),
            'created_at' => $product->getCreatedAt()?->format('Y-m-d H:i:s'),
            'updated_at' => $product->getUpdatedAt()?->format('Y-m-d H:i:s')
        ]);
        $responseDTO = ProductResponseDTO::fromProductDTO($productDTO);
        return response()->json($responseDTO->toArray());
    }

    public function delete(int $id)

    {
        $product = $this->deleteProductUseCase->execute($id);
        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
        return response()->json(['message' => 'Produto deletado com sucesso']);
    }
}