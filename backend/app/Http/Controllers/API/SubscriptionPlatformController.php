<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionPlatform\StoreSubscriptionPlatformRequest;
use App\Http\Requests\SubscriptionPlatform\UpdateSubscriptionPlatformRequest;
use App\Services\SubscriptionPlatformService;
use App\Models\SubscriptionPlatform;

use Illuminate\Http\Response;

class SubscriptionPlatformController extends Controller
{
    protected $subscriptionPlatformService;

    public function __construct(SubscriptionPlatformService $subscriptionPlatformService)
    {
        $this->subscriptionPlatformService = $subscriptionPlatformService;
    }

    public function index()
    {
        return $this->subscriptionPlatformService->all();
    }

    public function store(StoreSubscriptionPlatformRequest $request)
    {
        return $this->subscriptionPlatformService->create($request->validated());
    }

    public function show(SubscriptionPlatform $subscriptionPlatform)
    {
        return $this->subscriptionPlatformService->find($subscriptionPlatform);
    }

    public function update(UpdateSubscriptionPlatformRequest $request, SubscriptionPlatform $subscriptionPlatform)
    {
        return $this->subscriptionPlatformService->update($subscriptionPlatform, $request->validated());
    }

    public function destroy(SubscriptionPlatform $subscriptionPlatform)
    {
        $this->subscriptionPlatformService->delete($subscriptionPlatform);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
