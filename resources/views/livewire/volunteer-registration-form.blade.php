<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Volunteer Registration</h2>
        <p class="text-gray-600">Join us in making a difference in the lives of those who need it most.</p>
        
        <!-- Progress Bar -->
        <div class="mt-6">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Step {{ $currentStep }} of {{ $totalSteps }}</span>
                <span class="text-sm text-gray-500">{{ round(($currentStep / $totalSteps) * 100) }}% Complete</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-green-600 h-2 rounded-full transition-all duration-300" style="width: {{ ($currentStep / $totalSteps) * 100 }}%"></div>
            </div>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit="submitRegistration">
        <!-- Step 1: Personal Information -->
        @if ($currentStep === 1)
            <div class="space-y-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Personal Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="full_name"
                            wire:model.live="full_name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Enter your full name"
                        >
                        @error('full_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email"
                            wire:model.live="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Enter your email"
                        >
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="tel" 
                            id="phone"
                            wire:model.live="phone"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Enter your phone number"
                        >
                        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700 mb-1">
                            Age <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="age"
                            wire:model.live="age"
                            min="16"
                            max="80"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Enter your age"
                        >
                        @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                        Address <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="address"
                        wire:model.live="address"
                        rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Enter your full address"
                    ></textarea>
                    @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="city_id" class="block text-sm font-medium text-gray-700 mb-1">
                        City <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="city_id"
                        wire:model.live="city_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    >
                        <option value="">Select your city</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('city_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="education" class="block text-sm font-medium text-gray-700 mb-1">
                            Education (Optional)
                        </label>
                        <input 
                            type="text" 
                            id="education"
                            wire:model.live="education"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Your highest education level"
                        >
                    </div>

                    <div>
                        <label for="occupation" class="block text-sm font-medium text-gray-700 mb-1">
                            Occupation (Optional)
                        </label>
                        <input 
                            type="text" 
                            id="occupation"
                            wire:model.live="occupation"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Your current occupation"
                        >
                    </div>
                </div>
            </div>
        @endif

        <!-- Step 2: Skills and Availability -->
        @if ($currentStep === 2)
            <div class="space-y-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Skills and Availability</h3>
                
                <div>
                    <label for="skills" class="block text-sm font-medium text-gray-700 mb-1">
                        Skills and Expertise <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="skills"
                        wire:model.live="skills"
                        rows="4"
                        maxlength="1000"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Describe your skills, expertise, and what you can contribute (e.g., first aid, teaching, cooking, administrative work, etc.)"
                    ></textarea>
                    @error('skills') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <p class="text-xs text-gray-500 mt-1">{{ strlen($skills) }}/1000 characters</p>
                </div>

                <div>
                    <label for="availability" class="block text-sm font-medium text-gray-700 mb-1">
                        Availability <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="availability"
                        wire:model.live="availability"
                        rows="3"
                        maxlength="500"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="When are you available to volunteer? (e.g., weekends, evenings, specific days, hours per week)"
                    ></textarea>
                    @error('availability') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <p class="text-xs text-gray-500 mt-1">{{ strlen($availability) }}/500 characters</p>
                </div>

                <div>
                    <label for="motivation" class="block text-sm font-medium text-gray-700 mb-1">
                        Why do you want to volunteer with us? <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="motivation"
                        wire:model.live="motivation"
                        rows="4"
                        maxlength="1000"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Tell us about your motivation to volunteer and what you hope to achieve"
                    ></textarea>
                    @error('motivation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <p class="text-xs text-gray-500 mt-1">{{ strlen($motivation) }}/1000 characters</p>
                </div>
            </div>
        @endif

        <!-- Step 3: Emergency Contact & Experience -->
        @if ($currentStep === 3)
            <div class="space-y-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Emergency Contact & Experience</h3>
                
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h4 class="font-semibold text-blue-900 mb-2">Emergency Contact Information</h4>
                    <p class="text-blue-700 text-sm">Please provide someone we can contact in case of emergency while you're volunteering.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Emergency Contact Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="emergency_contact_name"
                            wire:model.live="emergency_contact_name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Full name of emergency contact"
                        >
                        @error('emergency_contact_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700 mb-1">
                            Emergency Contact Phone <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="tel" 
                            id="emergency_contact_phone"
                            wire:model.live="emergency_contact_phone"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Phone number of emergency contact"
                        >
                        @error('emergency_contact_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="has_volunteered_before"
                            wire:model.live="has_volunteered_before"
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                        >
                        <label for="has_volunteered_before" class="ml-2 block text-sm text-gray-700">
                            I have volunteered with other organizations before
                        </label>
                    </div>

                    @if ($has_volunteered_before)
                        <div>
                            <label for="previous_volunteer_experience" class="block text-sm font-medium text-gray-700 mb-1">
                                Previous Volunteer Experience <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="previous_volunteer_experience"
                                wire:model.live="previous_volunteer_experience"
                                rows="4"
                                maxlength="1000"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                placeholder="Please describe your previous volunteer experience, organizations you've worked with, and roles you've held"
                            ></textarea>
                            @error('previous_volunteer_experience') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            <p class="text-xs text-gray-500 mt-1">{{ strlen($previous_volunteer_experience) }}/1000 characters</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Step 4: Terms and Conditions -->
        @if ($currentStep === 4)
            <div class="space-y-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Terms and Conditions</h3>
                
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 max-h-64 overflow-y-auto">
                    <h4 class="font-semibold text-gray-900 mb-3">Volunteer Code of Conduct</h4>
                    <div class="space-y-3 text-sm text-gray-700">
                        <p><strong>1. Commitment:</strong> I understand that volunteering requires dedication and will honor my commitments to the organization and the people we serve.</p>
                        <p><strong>2. Respect:</strong> I will treat all beneficiaries, staff, and fellow volunteers with dignity, respect, and compassion regardless of their background.</p>
                        <p><strong>3. Confidentiality:</strong> I will maintain confidentiality of sensitive information about beneficiaries and organizational matters.</p>
                        <p><strong>4. Safety:</strong> I will follow all safety protocols and guidelines to ensure the wellbeing of myself and others.</p>
                        <p><strong>5. Professional Conduct:</strong> I will maintain professional behavior and represent the organization positively at all times.</p>
                        <p><strong>6. Non-discrimination:</strong> I will not discriminate against anyone based on race, religion, gender, age, or any other characteristic.</p>
                        <p><strong>7. Reporting:</strong> I will report any concerns or incidents to the appropriate supervisors immediately.</p>
                        <p><strong>8. Training:</strong> I will participate in required training sessions and follow organizational policies and procedures.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start">
                        <input 
                            type="checkbox" 
                            id="terms_accepted"
                            wire:model.live="terms_accepted"
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded mt-1"
                        >
                        <label for="terms_accepted" class="ml-2 block text-sm text-gray-700">
                            I have read and agree to abide by the Volunteer Code of Conduct and terms and conditions. I understand that failure to comply may result in termination of my volunteer status. <span class="text-red-500">*</span>
                        </label>
                    </div>
                    @error('terms_accepted') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <h4 class="font-semibold text-green-900 mb-2">What happens next?</h4>
                    <ul class="text-green-700 text-sm space-y-1">
                        <li>• Your application will be reviewed by our team</li>
                        <li>• We may contact you for a brief interview</li>
                        <li>• You'll receive training before starting your volunteer work</li>
                        <li>• We'll match you with opportunities that fit your skills and availability</li>
                    </ul>
                </div>
            </div>
        @endif

        <!-- Navigation Buttons -->
        <div class="flex justify-between pt-8 border-t border-gray-200">
            <button 
                type="button"
                wire:click="previousStep"
                class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                @disabled($currentStep === 1)
            >
                Previous
            </button>

            @if ($currentStep < $totalSteps)
                <button 
                    type="button"
                    wire:click="nextStep"
                    class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                >
                    Next Step
                </button>
            @else
                <button 
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="submitRegistration"
                    class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                    @disabled($isSubmitting || !$terms_accepted)
                >
                    <span wire:loading.remove wire:target="submitRegistration">
                        Submit Application
                    </span>
                    <span wire:loading wire:target="submitRegistration" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Submitting...
                    </span>
                </button>
            @endif
        </div>
    </form>
</div>