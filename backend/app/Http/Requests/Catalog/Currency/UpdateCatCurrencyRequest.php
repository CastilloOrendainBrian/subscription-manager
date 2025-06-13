<?php

namespace App\Http\Requests\Catalog\Currency;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCatCurrencyRequest extends FormRequest
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
            'acronym' => ['sometimes', 'required', 'string', 'max:5'],
            'active' => ['sometimes', 'required', 'boolean'],
        ];
    }
}
