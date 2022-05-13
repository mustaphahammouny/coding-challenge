<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->builder = $this->builder();
    }

    public function all(): Collection
    {
        return $this->builder->get();
    }

    public function create(array $data): Model
    {
        return $this->builder->create($data);
    }

    public function find(int $id): Model
    {
        return $this->builder->find($id);
    }

    public function delete(int $id): Model
    {
        $row = $this->builder->findOrFail($id);
        $row->delete();

        return $row;
    }
}
