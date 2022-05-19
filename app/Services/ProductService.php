<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Validators\StoreProductValidator;
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
     * @var StoreProductValidator
     */
    protected $storeProductValidator;

    /**
     * ProductService constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param FilesystemManager $filesystemManager
     * @param StoreProductValidator $storeProductValidator
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        FilesystemManager $filesystemManager,
        StoreProductValidator $storeProductValidator
    )
    {
        $this->productRepository = $productRepository;

        $this->filesystemManager = $filesystemManager;

        $this->storeProductValidator = $storeProductValidator;
    }

    public function index(array $data): AnonymousResourceCollection
    {
        $products = $this->productRepository->paginate($data);

        return ProductResource::collection($products);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function all(): AnonymousResourceCollection
    {
        $products = $this->productRepository->all();

        return ProductResource::collection($products);
    }

    /**
     * @param array $data
     * @return ProductResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(array $data): ProductResource
    {
        $data = $this->storeProductValidator->isValid($data);

        $data['image'] = $this->filesystemManager->disk('public')->putFile('products', $data['image']);
        $categories = $data['categories'] ?? [];
        unset($data['categories']);

        $product = $this->productRepository->create($data);

        if (count($categories) > 0) {
            $this->productRepository->attach($product->id, $categories);
        }

        return new ProductResource($product);
    }

    /**
     * @param int $id
     * @return ProductResource
     */
    public function destroy(int $id): ProductResource
    {
        $product = $this->productRepository->delete($id);

        return new ProductResource($product);
    }
}
