<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Make a Donation</h2>
        <p class="text-gray-600">Your contribution helps us provide care and support to those in need.</p>
    </div>

    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit="submitDonation" class="space-y-6">
        <!-- Donor Information -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900">Donor Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="donor_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="donor_name"
                        wire:model.live="donor_name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Enter your full name"
                        :disabled="$wire.anonymous"
                    >
                    @error('donor_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="donor_email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="donor_email"
                        wire:model.live="donor_email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Enter your email"
                    >
                    @error('donor_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="donor_phone" class="block text-sm font-medium text-gray-700 mb-1">
                    Phone Number
                </label>
                <input 
                    type="tel" 
                    id="donor_phone"
                    wire:model.live="donor_phone"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    placeholder="Enter your phone number"
                >
                @error('donor_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="anonymous"
                    wire:model.live="anonymous"
                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                >
                <label for="anonymous" class="ml-2 block text-sm text-gray-700">
                    Make this donation anonymous
                </label>
            </div>
        </div>

        <!-- Donation Details -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900">Donation Details</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">
                        Amount (NPR) <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="amount"
                        wire:model.live="amount"
                        min="10"
                        max="1000000"
                        step="1"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Enter amount"
                    >
                    @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <p class="text-xs text-gray-500 mt-1">Minimum: NPR 10, Maximum: NPR 1,000,000</p>
                </div>

                <div>
                    <label for="purpose" class="block text-sm font-medium text-gray-700 mb-1">
                        Donation Purpose <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="purpose"
                        wire:model.live="purpose"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    >
                        <option value="homeless_care">Homeless Care</option>
                        <option value="elderly_care">Elderly Care</option>
                        <option value="general_fund">General Fund</option>
                    </select>
                    @error('purpose') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900">Payment Method</h3>
            
            @if (!empty($availableGateways))
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($availableGateways as $gateway => $name)
                        <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 {{ $payment_method === $gateway ? 'border-green-500 bg-green-50' : '' }}">
                            <input 
                                type="radio" 
                                wire:model.live="payment_method"
                                value="{{ $gateway }}"
                                class="h-4 w-4 text-green-600 focus:ring-green-500"
                            >
                            <span class="ml-3 text-sm font-medium text-gray-700">{{ $name }}</span>
                        </label>
                    @endforeach
                </div>
            @else
                <div class="p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded">
                    Payment gateways are currently unavailable. Please try again later.
                </div>
            @endif
            @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Notes -->
        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                Additional Notes (Optional)
            </label>
            <textarea 
                id="notes"
                wire:model.live="notes"
                rows="3"
                maxlength="1000"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                placeholder="Any special message or instructions..."
            ></textarea>
            @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <p class="text-xs text-gray-500 mt-1">{{ strlen($notes) }}/1000 characters</p>
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button 
                type="submit"
                wire:loading.attr="disabled"
                wire:target="submitDonation"
                class="w-full bg-green-600 text-white py-3 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition duration-200"
                @disabled($isProcessing || empty($availableGateways))
            >
                <span wire:loading.remove wire:target="submitDonation">
                    Proceed to Payment
                </span>
                <span wire:loading wire:target="submitDonation" class="flex items-center justify-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                </span>
            </button>
        </div>

        <!-- Security Notice -->
        <div class="text-center text-sm text-gray-500">
            <p>🔒 Your payment information is secure and encrypted.</p>
            <p>You will receive a receipt via email after successful payment.</p>
        </div>
    </form>
</div>