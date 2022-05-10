<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

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

    public function index(array $data): AnonymousResourceCollection
    {
        $products = $this->productRepository->paginate($data);
        return ProductResource::collection($products);
    }

    public function store(array $data): ProductResource
    {
        $data['image'] = Storage::disk('public')->putFile('products', $data['image']);
        $product = $this->productRepository->create($data);
        $categories = $data['categories'] ?? [];
        if (count($categories) > 0) {
            $this->productRepository->attach($product->categories(), $categories);
        }
        return new ProductResource($product);
    }

    public function destroy($id): ProductResource
    {
        $category = $this->productRepository->delete($id);
        return new ProductResource($category);
    }
}
