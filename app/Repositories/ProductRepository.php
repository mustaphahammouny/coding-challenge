<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository extends BaseRepository
{
    /**
     * Specify builder name.
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return Product::query();
    }

    public function paginate($data)
    {
        $query = $this->builder;

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
