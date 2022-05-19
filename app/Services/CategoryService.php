<?php

namespace App\Services;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Validators\StoreCategoryValidator;

class CategoryService
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * @var StoreCategoryValidator
     */
    protected $storeCategoryValidator;

    /**
     * CategoryService constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     * @param StoreCategoryValidator $storeCategoryValidator
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        StoreCategoryValidator $storeCategoryValidator
    )
    {
        $this->categoryRepository = $categoryRepository;

        $this->storeCategoryValidator = $storeCategoryValidator;
    }

    /**
     * @return CategoryCollection
     */
    public function index(): CategoryCollection
    {
        $categories = $this->categoryRepository->all();

        return new CategoryCollection($categories);
    }

    /**
     * @param array $data
     * @return CategoryResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(array $data): CategoryResource
    {
        $data = $this->storeCategoryValidator->isValid($data);

        $category = $this->categoryRepository->create($data);

        return new CategoryResource($category);
    }

    /**
     * @param int $id
     * @return CategoryResource
     */
    public function destroy(int $id): CategoryResource
    {
        $category = $this->categoryRepository->delete($id);

        return new CategoryResource($category);
    }
}
