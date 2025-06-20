<?php

namespace App\Services;

use App\Http\Resources\SubscriptionPlatformResource;
use App\Repositories\SubscriptionPlatformRepository;
use App\Models\SubscriptionPlatform;

class SubscriptionPlatformService
{
    protected $subscriptionPlatformRepository;

    public function __construct(SubscriptionPlatformRepository $subscriptionPlatformRepository)
    {
        $this->subscriptionPlatformRepository = $subscriptionPlatformRepository;
    }

    public function all()
    {
        $platforms = $this->subscriptionPlatformRepository->all();
        return SubscriptionPlatformResource::collection($platforms);
    }

    public function create(array $data): SubscriptionPlatformResource
    {
        $platform = $this->subscriptionPlatformRepository->create($data);
        return new SubscriptionPlatformResource($platform);
    }

    public function find(SubscriptionPlatform $platform): SubscriptionPlatformResource
    {
        $platform = $this->subscriptionPlatformRepository->find($platform->id);
        return new SubscriptionPlatformResource($platform);
    }

    public function update(SubscriptionPlatform $platform, array $data): SubscriptionPlatformResource
    {
        $platform = $this->subscriptionPlatformRepository->update($platform, $data);
        return new SubscriptionPlatformResource($platform);
    }

    public function delete(SubscriptionPlatform $platform): void
    {
        $this->subscriptionPlatformRepository->delete($platform);
    }
}
