<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\StoreSubscriptionRequest;
use App\Http\Requests\Subscription\UpdateSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;

use Illuminate\Http\Response;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscription = Subscription::all();
        return SubscriptionResource::collection($subscription);
    }

    public function store(StoreSubscriptionRequest $request)
    {
        $subscription = Subscription::create($request->validated());
        return new SubscriptionResource($subscription);
    }

    public function show(Subscription $subscription)
    {
        return new SubscriptionResource($subscription);
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update($request->validated());
        return new SubscriptionResource($subscription);
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
