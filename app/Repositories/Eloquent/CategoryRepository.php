<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class CategoryRepositoryRepository extends BaseRepositoryRepository implements CategoryRepositoryInterface
{
    /**
     * Specify builder name.
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return Category::query();
    }
}
