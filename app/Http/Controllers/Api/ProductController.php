<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * CategoryController constructor.
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ProductCollection
     */
    public function index(Request $request): ProductCollection
    {
        $data = $request->only(['sort', 'order', 'categories']);

        return $this->productService->index($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return ProductResource
     */
    public function store(Request $request): ProductResource
    {
        $data = $request->only(['name', 'description', 'price', 'image', 'categories']);

        return $this->productService->store($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return ProductResource
     */
    public function destroy(int $id): ProductResource
    {
        return $this->productService->destroy($id);
    }
}
