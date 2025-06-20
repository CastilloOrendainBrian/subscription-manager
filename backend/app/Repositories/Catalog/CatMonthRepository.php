<?php

namespace App\Repositories\Catalog;

use App\Models\Catalog\CatMonth;

class CatMonthRepository
{
    protected $model;

    public function __construct(CatMonth $model)
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

    public function update(CatMonth $catMonth, array $data)
    {
        $catMonth->update($data);
        return $catMonth;
    }

    public function delete(CatMonth $catMonth)
    {
        return $catMonth->delete();
    }
}
