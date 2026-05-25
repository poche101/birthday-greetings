<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'sender_name'  => ['required', 'string', 'min:2', 'max:100'],
            'sender_email' => ['nullable', 'email', 'max:150'],
            'message'      => ['required', 'string', 'min:10', 'max:1000'],
            'relationship' => ['required', 'string', 'in:family,friend,colleague,church_member,well_wisher'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'sender_name.required'  => 'Please tell us your name.',
            'sender_name.min'       => 'Your name must be at least 2 characters.',
            'message.required'      => 'Please write a birthday message.',
            'message.min'           => 'Your message must be at least 10 characters.',
            'message.max'           => 'Your message cannot exceed 1,000 characters.',
            'relationship.required' => 'Please select your relationship to Pastor Funke.',
            'relationship.in'       => 'Please select a valid relationship.',
        ];
    }
}
