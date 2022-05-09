<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all(): AnonymousResourceCollection
    {
        $categories = $this->categoryRepository->all();
        return CategoryResource::collection($categories);
    }

    public function store(Request $request): CategoryResource
    {
        $data = $request->only(['name', 'parent_category']);
        $category = $this->categoryRepository->create($data);
        return new CategoryResource($category);
    }

    public function destroy($id): CategoryResource
    {
        $category = $this->categoryRepository->delete($id);
        return new CategoryResource($category);
    }
}
