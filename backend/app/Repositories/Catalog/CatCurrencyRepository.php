<?php

namespace App\Repositories\Catalog;

use App\Models\Catalog\CatCurrency;

class CatCurrencyRepository
{
    protected $model;

    public function __construct(CatCurrency $model)
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

    public function update(CatCurrency $catCurrency, array $data)
    {
        $catCurrency->update($data);
        return $catCurrency;
    }

    public function delete(CatCurrency $catCurrency)
    {
        return $catCurrency->delete();
    }
}