<?php

namespace App\Http\Requests\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
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
            'number_members_paying' => $this->input('numberMembersPaying', 1), // Default to 1 if not provided
            'active' => $this->input('active', true), // Default to true if not provided
            'user_id' => $this->input('userId', auth()->id()), // Default to authenticated user ID if not provided
            'subscription_platform_id' => $this->input('subscriptionPlatformId'),
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
            'number_members_paying' => ['required', 'integer', 'min:1'],
            'active' => ['sometimes', 'boolean'],
            'user_id' => ['required', 'exists:users,id'], // Ensure user_id is provided and exists
            'subscription_platform_id' => ['required', 'exists:subscription_platform,id'],
        ];
    }
}
