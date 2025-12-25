<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // If full_phone is present (from intl-tel-input), use it as the phone_number
        if ($this->has('full_phone')) {
            $this->merge([
                'phone_number' => $this->input('full_phone'),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone_number' => ['required', 'string', 'phone:INTERNATIONAL'],
            'government_id' => ['nullable', 'string', 'max:255'],
        ];
    }
}