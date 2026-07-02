<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepo implements IBaseRepo
{
    protected Model $model;
    protected string $table;
    protected Builder $query;

    public function __construct()
    {
        $this->model = $this->makeModel();
        $this->table = $this->model->getTable();
        $this->query = $this->model->query();
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    abstract protected function model(): string;

    protected function makeModel(): Model
    {
        $model = app()->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $model;
    }

    public function create(array $attributes): Model
    {
        $model = $this->model->newInstance();
        $model->fill($attributes);
        $model->save();

        return $model;
    }

    public function update(int|string $id, array $attributes): Model
    {
        $model = $this->model->findOrFail($id);
        $model->fill($attributes);
        $model->save();

        $this->resetQuery();

        return $model;
    }

    public function resetQuery(): Builder
    {
        return $this->query = $this->model->newQuery();
    }
}
