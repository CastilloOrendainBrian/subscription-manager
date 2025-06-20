<?php

namespace App\Http\Requests\Recurrence;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecurrenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $map = [
            'startDate' => 'start_date',
            'endDate' => 'end_date',
            'catTimeUnitId' => 'cat_time_unit_id',
            'catDayId' => 'cat_day_id',
            'catMonthId' => 'cat_month_id',
            'dateMonth' => 'date_month',
            'catWeekMonthId' => 'cat_week_month_id',
        ];

        $data = [];
        foreach ($map as $inputKey => $dbKey) {
            if ($this->has($inputKey)) {
            $data[$dbKey] = $this->input($inputKey);
            }
        }

        $this->merge($data);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => ['sometimes', 'date'],
            'end_date' => ['sometimes', 'nullable', 'date', 'after_or_equal:start_date'],
            'quantity' => ['sometimes', 'integer', 'min:1'],
            'cat_time_unit_id' => ['sometimes', 'exists:cat_time_unit,id'],
            'cat_day_id' => ['sometimes', 'nullable', 'exists:cat_day,id'],
            'cat_month_id' => ['sometimes', 'nullable', 'exists:cat_month,id'],
            'date_month' => ['sometimes', 'nullable', 'integer', 'between:1,31'],
            'cat_week_month_id' => ['sometimes', 'nullable', 'exists:cat_week_month,id'],
            'active' => ['sometimes', 'boolean'],
        ];
    }
}
