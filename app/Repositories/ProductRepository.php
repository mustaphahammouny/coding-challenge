<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function paginate($data)
    {
        $query = $this->model;

        if (isset($data['categories'])) {
            $query = $query->whereHas('categories', function ($query) use ($data) {
                $query->whereIn('categories.id', $data['categories']);
            });
        }

        if (isset($data['sort']) && isset($data['order'])) {
            $query = $query->orderBy($data['sort'], $data['order']);
        }

        return $query->paginate(9);
    }
}
