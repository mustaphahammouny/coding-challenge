<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class BaseRepository
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

    public function attach(Relation $relation, array $data): void
    {
        $relation->attach($data);
    }

    public function delete(int $id): Model
    {
        $row = $this->builder->findOrFail($id);
        $row->delete();
        return $row;
    }
}
