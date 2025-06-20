<?php

namespace App\Repositories\Catalog;

use App\Models\Catalog\CatTimeUnit;

class CatTimeUnitRepository
{
    protected $model;

    public function __construct(CatTimeUnit $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(CatTimeUnit $catTimeUnit, array $data)
    {
        $catTimeUnit->update($data);
        return $catTimeUnit;
    }

    public function delete(CatTimeUnit $catTimeUnit)
    {
        return $catTimeUnit->delete();
    }
}
