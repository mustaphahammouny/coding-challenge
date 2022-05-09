<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_product()
    {
        Storage::fake('products');

        $response = $this->postJson('/api/products', [
            'name' => 'glass',
            'price' => 59.99,
            'image' => UploadedFile::fake()->image('product.jpg'),
            'description' => 'Best glass ever',
        ]);

        $response->assertStatus(201);
    }
}
