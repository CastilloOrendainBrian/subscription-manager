<?php

namespace App\Repositories;

use App\Models\SubscriptionPlatform;

class SubscriptionPlatformRepository
{
    protected $model;

    public function __construct(SubscriptionPlatform $model)
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

    public function update(SubscriptionPlatform $subscriptionPlatform, array $data)
    {
        $subscriptionPlatform->update($data);
        return $subscriptionPlatform;
    }

    public function delete(SubscriptionPlatform $subscriptionPlatform)
    {
        return $subscriptionPlatform->delete();
    }
}
