<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_create_product(): void
    {
        $productData = [
            'name' => 'Produto Teste',
            'category' => 'Categoria Teste',
            'status' => 'ACTIVE',
            'quantity' => 10
        ];

        $response = $this->postJson('/api/products/', $productData);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'id',
                     'name',
                     'category',
                     'status',
                     'quantity',
                     'created_at',
                     'updated_at'
                 ]);
    }

    public function test_can_list_products(): void
    {
        $response = $this->getJson('/api/products/');

        $response->assertStatus(200)
                 ->assertJsonStructure([]);
    }

    public function test_product_validation(): void
    {
        $invalidData = [
            'name' => '',
            'category' => 'Test',
            'status' => 'INVALID_STATUS',
            'quantity' => -5
        ];

        $response = $this->postJson('/api/products/', $invalidData);

        $response->assertStatus(422);
    }
}
