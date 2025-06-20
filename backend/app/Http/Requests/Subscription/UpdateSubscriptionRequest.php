<?php

namespace App\Http\Requests\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionRequest extends FormRequest
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
            'numberMembersPaying' => 'number_members_paying',
            'userId' => 'user_id',
            'subscriptionPlatformId' => 'subscription_platform_id',
            'active' => 'active',
        ];

        $data = [];
        foreach ($map as $inputKey => $dbKey) {
            if ($this->has($inputKey)) {
            $data[$dbKey] = $this->input($inputKey, $defaults[$inputKey] ?? null);
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
            'number_members_paying' => ['sometimes', 'integer', 'min:1'],
            'active' => ['sometimes', 'boolean'],
            'user_id' => ['sometimes', 'exists:users,id'], // Ensure user_id is provided and exists
            'subscription_platform_id' => ['sometimes', 'exists:subscription_platform,id'],
        ];
    }
}
