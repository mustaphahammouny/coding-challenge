<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    /**
     * Specify model class name.
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }
}
