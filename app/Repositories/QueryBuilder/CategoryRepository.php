<?php

namespace App\Repositories\QueryBuilder;

use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * Specify table name.
     *
     * @return string
     */
    public function table(): string
    {
        return 'categories';
    }
}
