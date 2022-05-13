<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductService
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var FilesystemManager
     */
    protected $filesystemManager;

    /**
     * ProductService constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param FilesystemManager $filesystemManager
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        FilesystemManager $filesystemManager
    )
    {
        $this->productRepository = $productRepository;

        $this->filesystemManager = $filesystemManager;
    }

    public function index(array $data): AnonymousResourceCollection
    {
        $products = $this->productRepository->paginate($data);

        return ProductResource::collection($products);
    }

    public function all(): AnonymousResourceCollection
    {
        $products = $this->productRepository->all();

        return ProductResource::collection($products);
    }

    public function store(array $data): ProductResource
    {
        $data['image'] = $this->filesystemManager->disk('public')->putFile('products', $data['image']);
        $categories = $data['categories'] ?? [];
        unset($data['categories']);

        $product = $this->productRepository->create($data);

        if (count($categories) > 0) {
            $this->productRepository->attach($product->id, $categories);
        }

        return new ProductResource($product);
    }

    public function destroy(int $id): ProductResource
    {
        $product = $this->productRepository->delete($id);

        return new ProductResource($product);
    }
}
