<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    public function index(): Collection
    {
        return $this->categoryRepository->all();
    }

    public function store(array $data): Model
    {
        return $this->categoryRepository->create($data);
    }

    public function destroy($id): Model
    {
        return $this->categoryRepository->delete($id);
    }
}
