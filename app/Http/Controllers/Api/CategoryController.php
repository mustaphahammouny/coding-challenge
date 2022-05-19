<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * CategoryController constructor.
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return CategoryCollection
     */
    public function index(): CategoryCollection
    {
        return $this->categoryService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return CategoryResource|JsonResponse
     */
    public function store(Request $request): CategoryResource
    {
        $data = $request->only(['name', 'parent_category']);

        return $this->categoryService->store($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return CategoryResource
     */
    public function destroy(int $id): CategoryResource
    {
        return $this->categoryService->destroy($id);
    }
}
