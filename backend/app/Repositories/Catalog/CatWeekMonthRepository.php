<?php

namespace App\Repositories\Catalog;

use App\Models\Catalog\CatWeekMonth;

class CatWeekMonthRepository
{
    protected $model;

    public function __construct(CatWeekMonth $model)
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

    public function update(CatWeekMonth $catWeekMonth, array $data)
    {
        $catWeekMonth->update($data);
        return $catWeekMonth;
    }

    public function delete(CatWeekMonth $catWeekMonth)
    {
        return $catWeekMonth->delete();
    }
}
