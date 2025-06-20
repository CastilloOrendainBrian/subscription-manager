<?php

namespace App\Http\Requests\Recurrence;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecurrenceRequest extends FormRequest
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
            'quantity' => 'quantity',
            'catTimeUnitId' => 'cat_time_unit_id',
            'catDayId' => 'cat_day_id',
            'catMonthId' => 'cat_month_id',
            'dateMonth' => 'date_month',
            'catWeekMonthId' => 'cat_week_month_id',
            'active' => 'active',
        ];

        $defaults = [
            'quantity' => 1,
            'active' => true,
        ];

        $data = [];
        foreach ($map as $inputKey => $dbKey) {
            if ($this->has($inputKey)) {
            $data[$dbKey] = $this->input($inputKey, $defaults[$inputKey] ?? null);
            }
        }

        // Set defaults if not present
        foreach ($defaults as $inputKey => $default) {
            $dbKey = $map[$inputKey];
            if (!isset($data[$dbKey])) {
            $data[$dbKey] = $default;
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
            'start_date' => ['required', 'date'],
            'end_date' => ['sometimes', 'nullable', 'date', 'after_or_equal:start_date'],
            'quantity' => ['required', 'integer', 'min:1'],
            'cat_time_unit_id' => ['required', 'exists:cat_time_unit,id'],
            'cat_day_id' => ['sometimes', 'nullable', 'exists:cat_day,id'],
            'cat_month_id' => ['sometimes', 'nullable', 'exists:cat_month,id'],
            'date_month' => ['sometimes', 'nullable', 'integer', 'between:1,31'],
            'cat_week_month_id' => ['sometimes', 'nullable', 'exists:cat_week_month,id'],
            'active' => ['required', 'boolean'],
        ];
    }
}
