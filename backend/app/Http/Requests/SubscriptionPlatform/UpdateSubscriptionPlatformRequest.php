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
        $this->merge([
            'active' => $this->input('active', true), // Default to true if not provided
            'cat_currency_id' => $this->input('catCurrencyId'),
            'recurrence_id' => $this->input('recurrenceId'),
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
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'type' => ['sometimes', 'required', 'string', 'max:255'],
            'members' => ['sometimes', 'required', 'integer', 'min:1'],
            'price' => ['sometimes', 'required', 'numeric', 'min:1'],
            'active' => ['sometimes', 'required', 'boolean'],
            'cat_currency_id' => ['sometimes', 'required', 'exists:cat_currency,id'],
            'recurrence_id' => ['sometimes', 'required', 'exists:recurrence,id'],
        ];
    }
}
