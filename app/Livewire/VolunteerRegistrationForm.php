<?php

namespace App\Livewire;

use App\Models\Volunteer;
use App\Models\City;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class VolunteerRegistrationForm extends Component
{
    public $full_name = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $city_id = '';
    public $skills = '';
    public $availability = '';
    public $motivation = '';
    public $age = '';
    public $education = '';
    public $occupation = '';
    public $emergency_contact_name = '';
    public $emergency_contact_phone = '';
    public $has_volunteered_before = false;
    public $previous_volunteer_experience = '';
    public $terms_accepted = false;

    public $cities = [];
    public $isSubmitting = false;
    public $currentStep = 1;
    public $totalSteps = 4;

    protected function rules()
    {
        $rules = [
            'full_name' => 'required|string|max:255|regex:/^[a-zA-Z\s\u0900-\u097F]+$/u',
            'email' => 'required|email|max:255|unique:volunteers,email',
            'phone' => 'required|string|max:20|regex:/^[0-9+\-\s()]+$/',
            'address' => 'required|string|max:500',
            'city_id' => 'required|exists:cities,id',
            'skills' => 'required|string|max:1000',
            'availability' => 'required|string|max:500',
            'motivation' => 'required|string|max:1000',
            'age' => 'required|integer|min:16|max:80',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20|regex:/^[0-9+\-\s()]+$/',
            'has_volunteered_before' => 'boolean',
            'terms_accepted' => 'required|accepted',
        ];

        // Add conditional rules
        if ($this->has_volunteered_before) {
            $rules['previous_volunteer_experience'] = 'required|string|max:1000';
        }

        return $rules;
    }

    protected $messages = [
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
        'previous_volunteer_experience.required' => 'Please describe your previous volunteer experience.',
        'terms_accepted.required' => 'You must accept the terms and conditions.',
        'terms_accepted.accepted' => 'You must accept the terms and conditions.',
    ];

    public function mount()
    {
        $this->cities = City::where('is_active', true)->orderBy('name')->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function nextStep()
    {
        $this->validateCurrentStep();
        
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function validateCurrentStep()
    {
        $stepRules = $this->getStepRules($this->currentStep);
        $this->validate($stepRules);
    }

    private function getStepRules($step)
    {
        $allRules = $this->rules();
        
        switch ($step) {
            case 1: // Personal Information
                return array_intersect_key($allRules, array_flip([
                    'full_name', 'email', 'phone', 'address', 'city_id', 'age'
                ]));
            case 2: // Skills and Availability
                return array_intersect_key($allRules, array_flip([
                    'skills', 'availability', 'motivation', 'education', 'occupation'
                ]));
            case 3: // Emergency Contact & Experience
                return array_intersect_key($allRules, array_flip([
                    'emergency_contact_name', 'emergency_contact_phone', 
                    'has_volunteered_before', 'previous_volunteer_experience'
                ]));
            case 4: // Terms and Conditions
                return array_intersect_key($allRules, array_flip(['terms_accepted']));
            default:
                return [];
        }
    }

    public function submitRegistration()
    {
        $this->validate();

        if ($this->isSubmitting) {
            return;
        }

        $this->isSubmitting = true;

        try {
            $volunteer = Volunteer::create([
                'full_name' => $this->full_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'city_id' => $this->city_id,
                'skills' => $this->skills,
                'availability' => $this->availability,
                'motivation' => $this->motivation,
                'age' => $this->age,
                'education' => $this->education,
                'occupation' => $this->occupation,
                'emergency_contact_name' => $this->emergency_contact_name,
                'emergency_contact_phone' => $this->emergency_contact_phone,
                'has_volunteered_before' => $this->has_volunteered_before,
                'previous_volunteer_experience' => $this->previous_volunteer_experience,
                'status' => 'pending',
            ]);

            Log::info('Volunteer registration submitted', [
                'volunteer_id' => $volunteer->id,
                'email' => $volunteer->email,
                'city' => $volunteer->city->name
            ]);

            session()->flash('success', 'Thank you for your interest in volunteering! Your application has been submitted and is pending review. We will contact you soon.');
            
            // Reset form
            $this->reset();
            $this->currentStep = 1;

        } catch (\Exception $e) {
            Log::error('Volunteer registration failed', [
                'error' => $e->getMessage(),
                'email' => $this->email
            ]);

            session()->flash('error', 'An error occurred while submitting your application. Please try again.');
        } finally {
            $this->isSubmitting = false;
        }
    }

    public function render()
    {
        return view('livewire.volunteer-registration-form');
    }
}