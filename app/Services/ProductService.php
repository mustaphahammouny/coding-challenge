<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductService
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * ProductService constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function store(Request $request): ProductResource
    {
        $data = $request->only(['name', 'description', 'price']);
        $data['image'] = $request->file('image')->store('products', 'public');
        $product = $this->productRepository->create($data);
        $categories = $request->has('categories') ? $request->input('categories') : [];
        if (count($categories) > 0) {
            $this->productRepository->attach($product->categories(), $categories);
        }
        return new ProductResource($product);
    }
}
