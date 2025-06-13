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
        $this->merge([
            'start_date' => $this->input('startDate'),
            'end_date' => $this->input('endDate'),
            'cat_time_unit_id' => $this->input('catTimeUnitId'),
            'cat_day_id' => $this->input('catDayId'),
            'cat_month_id' => $this->input('catMonthId'),
            'date_month' => $this->input('dateMonth'),
            'cat_week_month_id' => $this->input('catWeekMonthId'),
            'active' => $this->input('active', true), // Default to true if not provided
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => ['sometimes', 'required', 'date'],
            'end_date' => ['sometimes', 'nullable', 'date', 'after_or_equal:start_date'],
            'quantity' => ['sometimes', 'required', 'integer', 'min:1'],
            'cat_time_unit_id' => ['sometimes', 'required', 'exists:cat_time_unit,id'],
            'cat_day_id' => ['sometimes', 'nullable', 'exists:cat_day,id'],
            'cat_month_id' => ['sometimes', 'nullable', 'exists:cat_month,id'],
            'date_month' => ['sometimes', 'nullable', 'integer', 'between:1,31'],
            'cat_week_month_id' => ['sometimes', 'nullable', 'exists:cat_week_month,id'],
            'active' => ['sometimes', 'boolean'],
        ];
    }
}
