<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'donor_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\u0900-\u097F]+$/u'],
            'donor_email' => ['required', 'email', 'max:255'],
            'donor_phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
            'amount' => ['required', 'numeric', 'min:10', 'max:1000000'],
            'currency' => ['required', 'string', 'in:NPR'],
            'purpose' => ['required', 'string', 'in:homeless_care,elderly_care,general_fund'],
            'payment_method' => ['required', 'string', 'in:esewa,khalti,bank_transfer'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'anonymous' => ['boolean'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'donor_name.required' => 'Donor name is required.',
            'donor_name.regex' => 'Donor name can only contain letters and spaces.',
            'donor_email.required' => 'Email address is required.',
            'donor_email.email' => 'Please provide a valid email address.',
            'donor_phone.regex' => 'Please provide a valid phone number.',
            'amount.required' => 'Donation amount is required.',
            'amount.min' => 'Minimum donation amount is NPR 10.',
            'amount.max' => 'Maximum donation amount is NPR 1,000,000.',
            'purpose.required' => 'Please select a donation purpose.',
            'purpose.in' => 'Invalid donation purpose selected.',
            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in' => 'Invalid payment method selected.',
            'notes.max' => 'Notes cannot exceed 1000 characters.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'donor_name' => strip_tags($this->donor_name),
            'donor_email' => strtolower(strip_tags($this->donor_email)),
            'donor_phone' => preg_replace('/[^0-9+\-\s()]/', '', $this->donor_phone ?? ''),
            'notes' => strip_tags($this->notes ?? ''),
            'anonymous' => $this->boolean('anonymous'),
        ]);
    }
}