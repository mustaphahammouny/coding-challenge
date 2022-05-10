<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->model = App::make($this->model());
    }

    public function all()
    {
        return $this->model::all();
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
