<?php

namespace App\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function paginate(array $data): LengthAwarePaginator;

    public function attach(int $id, array $data): void;
}
