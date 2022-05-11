<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class CategoryRepository extends BaseRepository
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
