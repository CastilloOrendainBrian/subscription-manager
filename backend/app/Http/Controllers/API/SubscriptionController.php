<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\StoreSubscriptionRequest;
use App\Http\Requests\Subscription\UpdateSubscriptionRequest;
use App\Services\SubscriptionService;
use App\Models\Subscription;

use Illuminate\Http\Response;

class SubscriptionController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function index()
    {
        return $this->subscriptionService->all();
    }

    public function store(StoreSubscriptionRequest $request)
    {
        return $this->subscriptionService->create($request->validated());
    }

    public function show(Subscription $subscription)
    {
        return $this->subscriptionService->find($subscription);
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        return $this->subscriptionService->update($subscription, $request->validated());
    }

    public function destroy(Subscription $subscription)
    {
        $this->subscriptionService->delete($subscription);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
