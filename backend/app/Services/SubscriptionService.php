<?php

namespace App\Services;

use App\Http\Resources\SubscriptionResource;
use App\Repositories\SubscriptionRepository;
use App\Models\Subscription;

class SubscriptionService
{
    protected $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function all()
    {
        $subscriptions = $this->subscriptionRepository->all();
        return SubscriptionResource::collection($subscriptions);
    }

    public function create(array $data): SubscriptionResource
    {
        $subscription = $this->subscriptionRepository->create($data);
        return new SubscriptionResource($subscription);
    }

    public function find(Subscription $subscription): SubscriptionResource
    {
        $subscription = $this->subscriptionRepository->find($subscription->id);
        return new SubscriptionResource($subscription);
    }

    public function update(Subscription $subscription, array $data): SubscriptionResource
    {
        $subscription = $this->subscriptionRepository->update($subscription, $data);
        return new SubscriptionResource($subscription);
    }

    public function delete(Subscription $subscription): void
    {
        $this->subscriptionRepository->delete($subscription);
    }
}
