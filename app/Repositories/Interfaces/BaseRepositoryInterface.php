<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function find(int $id);

    public function delete(int $id);
}
