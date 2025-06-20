<?php

namespace App\Repositories;

use App\Models\Recurrence;

class RecurrenceRepository
{
    protected $model;

    public function __construct(Recurrence $model)
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

    public function update(Recurrence $recurrence, array $data)
    {
        $recurrence->update($data);
        return $recurrence;
    }

    public function delete(Recurrence $recurrence)
    {
        return $recurrence->delete();
    }
}
