<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        return $this->model::create($data);
    }

    public function attach($relation, $data)
    {
        $relation->attach($data);
    }

    public function delete($id)
    {
        $row = $this->model::findOrFail($id);
        $row->delete();
        return $row;
    }
}
