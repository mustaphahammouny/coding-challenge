<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

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

    public function all()
    {
        return $this->builder->get();
    }

    public function create($data)
    {
        return $this->builder->create($data);
    }

    public function attach($relation, $data)
    {
        $relation->attach($data);
    }

    public function delete($id)
    {
        $row = $this->builder->findOrFail($id);
        $row->delete();
        return $row;
    }
}
