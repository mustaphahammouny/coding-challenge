<?php

namespace App\Repositories\QueryBuilder;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * Specify table name.
     *
     * @return string
     */
    public function table(): string
    {
        return 'products';
    }

    public function paginate(array $data): LengthAwarePaginator
    {
        $query = $this->builder;

        if (isset($data['categories'])) {
            $query = $query->join('category_product',
                'products.id', '=', 'category_product.product_id')
                ->whereIn('category_product.category_id', $data['categories']);
        }

        if (isset($data['sort']) && isset($data['order'])) {
            $query = $query->orderBy($data['sort'], $data['order']);
        }

        return $query->paginate(9);
    }

    public function attach(int $id, array $data): void
    {
        $product = $this->find($id);

        $rows = [];
        foreach ($data as $relation) {
            array_push($rows, [
                'category_id' => $relation,
                'product_id' => $product->id,
            ]);
        }

        $this->databaseManager->table('category_product')
            ->insert($rows);
    }
}
