<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VolunteerRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\u0900-\u097F]+$/u'],
            'email' => ['required', 'email', 'max:255', 'unique:volunteers,email'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
            'address' => ['required', 'string', 'max:500'],
            'city_id' => ['required', 'exists:cities,id'],
            'skills' => ['required', 'string', 'max:1000'],
            'availability' => ['required', 'string', 'max:500'],
            'motivation' => ['required', 'string', 'max:1000'],
            'age' => ['required', 'integer', 'min:16', 'max:80'],
            'education' => ['nullable', 'string', 'max:255'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'emergency_contact_name' => ['required', 'string', 'max:255'],
            'emergency_contact_phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
            'has_volunteered_before' => ['boolean'],
            'previous_volunteer_experience' => ['nullable', 'string', 'max:1000'],
            'terms_accepted' => ['required', 'accepted'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name is required.',
            'full_name.regex' => 'Name can only contain letters and spaces.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered as a volunteer.',
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Please provide a valid phone number.',
            'address.required' => 'Address is required.',
            'city_id.required' => 'Please select a city.',
            'city_id.exists' => 'Selected city is invalid.',
            'skills.required' => 'Please describe your skills.',
            'availability.required' => 'Please describe your availability.',
            'motivation.required' => 'Please tell us why you want to volunteer.',
            'age.required' => 'Age is required.',
            'age.min' => 'Volunteers must be at least 16 years old.',
            'age.max' => 'Please contact us directly if you are over 80.',
            'emergency_contact_name.required' => 'Emergency contact name is required.',
            'emergency_contact_phone.required' => 'Emergency contact phone is required.',
            'emergency_contact_phone.regex' => 'Please provide a valid emergency contact phone.',
            'terms_accepted.required' => 'You must accept the terms and conditions.',
            'terms_accepted.accepted' => 'You must accept the terms and conditions.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'full_name' => strip_tags($this->full_name),
            'email' => strtolower(strip_tags($this->email)),
            'phone' => preg_replace('/[^0-9+\-\s()]/', '', $this->phone ?? ''),
            'address' => strip_tags($this->address ?? ''),
            'skills' => strip_tags($this->skills ?? ''),
            'availability' => strip_tags($this->availability ?? ''),
            'motivation' => strip_tags($this->motivation ?? ''),
            'education' => strip_tags($this->education ?? ''),
            'occupation' => strip_tags($this->occupation ?? ''),
            'emergency_contact_name' => strip_tags($this->emergency_contact_name ?? ''),
            'emergency_contact_phone' => preg_replace('/[^0-9+\-\s()]/', '', $this->emergency_contact_phone ?? ''),
            'previous_volunteer_experience' => strip_tags($this->previous_volunteer_experience ?? ''),
            'has_volunteered_before' => $this->boolean('has_volunteered_before'),
            'terms_accepted' => $this->boolean('terms_accepted'),
        ]);
    }
}