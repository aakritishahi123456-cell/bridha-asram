<?php

namespace App\Livewire;

use App\Http\Requests\DonationRequest;
use App\Models\Donation;
use App\Services\Payment\PaymentManager;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DonationForm extends Component
{
    public $donor_name = '';
    public $donor_email = '';
    public $donor_phone = '';
    public $amount = '';
    public $purpose = 'homeless_care';
    public $payment_method = 'esewa';
    public $notes = '';
    public $anonymous = false;

    public $availableGateways = [];
    public $isProcessing = false;

    protected $rules = [
        'donor_name' => 'required|string|max:255|regex:/^[a-zA-Z\s\u0900-\u097F]+$/u',
        'donor_email' => 'required|email|max:255',
        'donor_phone' => 'nullable|string|max:20|regex:/^[0-9+\-\s()]+$/',
        'amount' => 'required|numeric|min:10|max:1000000',
        'purpose' => 'required|string|in:homeless_care,elderly_care,general_fund',
        'payment_method' => 'required|string|in:esewa,khalti,bank_transfer',
        'notes' => 'nullable|string|max:1000',
        'anonymous' => 'boolean',
    ];

    protected $messages = [
        'donor_name.required' => 'Donor name is required.',
        'donor_name.regex' => 'Donor name can only contain letters and spaces.',
        'donor_email.required' => 'Email address is required.',
        'donor_email.email' => 'Please provide a valid email address.',
        'donor_phone.regex' => 'Please provide a valid phone number.',
        'amount.required' => 'Donation amount is required.',
        'amount.min' => 'Minimum donation amount is NPR 10.',
        'amount.max' => 'Maximum donation amount is NPR 1,000,000.',
        'purpose.required' => 'Please select a donation purpose.',
        'payment_method.required' => 'Please select a payment method.',
    ];

    public function mount()
    {
        $paymentManager = new PaymentManager();
        $this->availableGateways = $paymentManager->getAvailableGateways();
        
        // Set default payment method to first available gateway
        if (!empty($this->availableGateways)) {
            $this->payment_method = array_key_first($this->availableGateways);
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitDonation()
    {
        $this->validate();

        if ($this->isProcessing) {
            return;
        }

        $this->isProcessing = true;

        try {
            DB::beginTransaction();

            // Create donation record
            $donation = Donation::create([
                'donor_name' => $this->anonymous ? 'Anonymous' : $this->donor_name,
                'donor_email' => $this->donor_email,
                'donor_phone' => $this->donor_phone,
                'amount' => $this->amount,
                'currency' => 'NPR',
                'purpose' => $this->purpose,
                'payment_method' => $this->payment_method,
                'notes' => $this->notes,
                'payment_status' => 'pending',
            ]);

            // Generate receipt number
            $donation->receipt_number = 'NGO-' . str_pad($donation->id, 6, '0', STR_PAD_LEFT) . '-' . date('Y');
            $donation->save();

            // Initiate payment
            $paymentManager = new PaymentManager();
            $paymentService = $paymentManager->gateway($this->payment_method);
            
            $paymentResponse = $paymentService->initiatePayment([
                'amount' => $this->amount,
                'donor_name' => $this->anonymous ? 'Anonymous' : $this->donor_name,
                'donor_email' => $this->donor_email,
                'donor_phone' => $this->donor_phone,
                'purpose' => $this->purpose,
                'donation_id' => $donation->id,
            ]);

            if ($paymentResponse->success) {
                // Update donation with transaction ID
                $donation->update([
                    'transaction_id' => $paymentResponse->transactionId,
                ]);

                DB::commit();

                // Redirect to payment gateway
                if ($paymentResponse->redirectUrl) {
                    return redirect($paymentResponse->redirectUrl);
                }

                session()->flash('success', 'Payment initiated successfully.');
                $this->reset();
            } else {
                DB::rollBack();
                session()->flash('error', $paymentResponse->errorMessage ?? 'Payment initiation failed.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Donation processing failed', [
                'error' => $e->getMessage(),
                'donor_email' => $this->donor_email,
                'amount' => $this->amount
            ]);

            session()->flash('error', 'An error occurred while processing your donation. Please try again.');
        } finally {
            $this->isProcessing = false;
        }
    }

    public function render()
    {
        return view('livewire.donation-form');
    }
}