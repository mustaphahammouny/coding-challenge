<?php

namespace App\Repositories\QueryBuilder;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use stdClass;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * BaseRepository constructor.
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;

        $this->builder = $this->databaseManager->table($this->table());
    }

    public function all(): Collection
    {
        return $this->builder->selectRaw('*, DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s")')
            ->get();
    }

    public function create(array $data): stdClass
    {
        $now = Carbon::now();
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        $id = $this->builder->insertGetId($data);

        return $this->find($id);
    }

    public function find(int $id): stdClass
    {
        return $this->builder->find($id);
    }

    public function delete(int $id): stdClass
    {
        $row = $this->find($id);

        $this->builder->whereId($id)->delete();

        return $row;
    }
}
