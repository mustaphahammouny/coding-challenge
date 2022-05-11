<?php

namespace App\Services;

use App\Repositories\ProductRepository;
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

    public function index(array $data)
    {
        return $this->productRepository->paginate($data);
    }

    public function store(array $data)
    {
        $data['image'] = Storage::disk('public')->putFile('products', $data['image']);
        $product = $this->productRepository->create($data);
        $categories = $data['categories'] ?? [];
        if (count($categories) > 0) {
            $this->productRepository->attach($product->categories(), $categories);
        }

        return $product;
    }

    public function destroy($id)
    {
        return $this->productRepository->delete($id);
    }
}
