<?php

namespace App\Http\Requests\SubscriptionPlatform;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionPlatformRequest extends FormRequest
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
            'members' => $this->input('members', 1), // Default to 1 if not provided
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
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'members' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:1'],
            'active' => ['required', 'boolean'],
            'cat_currency_id' => ['required', 'exists:cat_currency,id'],
            'recurrence_id' => ['required', 'exists:recurrence,id'],
        ];
    }
}
