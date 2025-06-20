<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecurrenceResource extends JsonResource
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'quantity' => $this->quantity,
            'cat_time_unit_id' => $this->cat_time_unit_id,
            'cat_day_id' => $this->cat_day_id,
            'cat_month_id' => $this->cat_month_id,
            'date_month' => $this->date_month,
            'cat_week_month_id' => $this->cat_week_month_id,
            'active' => $this->active,
        ];
    }
}
