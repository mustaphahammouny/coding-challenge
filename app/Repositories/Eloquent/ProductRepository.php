<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
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

    public function paginate(array $data): LengthAwarePaginator
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

    public function attach(int $id, array $data): void
    {
        $product = $this->builder->find($id);

        $product->categories()->attach($data);
    }
}
