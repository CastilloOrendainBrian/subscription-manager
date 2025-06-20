<?php

namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository
{
    protected $model;

    public function __construct(Subscription $model)
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

    public function update(Subscription $subscription, array $data)
    {
        $subscription->update($data);
        return $subscription;
    }

    public function delete(Subscription $subscription)
    {
        return $subscription->delete();
    }
}
