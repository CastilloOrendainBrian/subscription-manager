<?php

namespace App\Http\Requests\SubscriptionPlatform;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionPlatformRequest extends FormRequest
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
        $mappings = [
            'startDate' => 'start_date',
            'catCurrencyId' => 'cat_currency_id',
            'recurrenceId' => 'recurrence_id',
        ];

        $data = [];
        foreach ($mappings as $inputKey => $dbKey) {
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
            'name' => ['sometimes', 'string', 'max:255', 'min:1'],
            'type' => ['sometimes', 'string', 'max:255', 'min:1'],
            'members' => ['sometimes', 'integer', 'min:1'],
            'price' => ['sometimes', 'numeric', 'min:1'],
            'active' => ['sometimes', 'boolean'],
            'cat_currency_id' => ['sometimes', 'exists:cat_currency,id'],
            'recurrence_id' => ['sometimes', 'exists:recurrence,id'],
        ];
    }
}
