<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        $categories = $this->categoryRepository->all();

        return CategoryResource::collection($categories);
    }

    public function store(array $data): CategoryResource
    {
        $category = $this->categoryRepository->create($data);

        return new CategoryResource($category);
    }

    public function destroy(int $id): CategoryResource
    {
        $category = $this->categoryRepository->delete($id);

        return new CategoryResource($category);
    }
}
