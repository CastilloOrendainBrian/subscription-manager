<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionPlatform\StoreSubscriptionPlatformRequest;
use App\Http\Requests\SubscriptionPlatform\UpdateSubscriptionPlatformRequest;
use App\Http\Resources\SubscriptionPlatformResource;
use App\Models\SubscriptionPlatform;

use Illuminate\Http\Response;

class SubscriptionPlatformController extends Controller
{
    public function index()
    {
        $subscriptionPlatform = SubscriptionPlatform::all();
        return SubscriptionPlatformResource::collection($subscriptionPlatform);
    }

    public function store(StoreSubscriptionPlatformRequest $request)
    {
        $subscriptionPlatform = SubscriptionPlatform::create($request->validated());
        return new SubscriptionPlatformResource($subscriptionPlatform);
    }

    public function show(SubscriptionPlatform $subscriptionPlatform)
    {
        return new SubscriptionPlatformResource($subscriptionPlatform);
    }

    public function update(UpdateSubscriptionPlatformRequest $request, SubscriptionPlatform $subscriptionPlatform)
    {
        $subscriptionPlatform->update($request->validated());
        return new SubscriptionPlatformResource($subscriptionPlatform);
    }

    public function destroy(SubscriptionPlatform $subscriptionPlatform)
    {
        $subscriptionPlatform->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
