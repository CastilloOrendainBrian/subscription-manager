<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number_members_paying' => $this->number_members_paying,
            'active' => $this->active,
            'user_id' => $this->user_id,
            'subscription_platform_id' => $this->subscription_platform_id,
        ];
    }
}
