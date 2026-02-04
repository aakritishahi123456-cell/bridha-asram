<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonationRequest;
use App\Models\Donation;
use App\Services\Payment\PaymentManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DonationController extends Controller
{
    private PaymentManager $paymentManager;

    public function __construct(PaymentManager $paymentManager)
    {
        $this->paymentManager = $paymentManager;
    }

    /**
     * Show the donation form
     */
    public function create()
    {
        $availableGateways = $this->paymentManager->getAvailableGateways();
        
        return view('donations.create', compact('availableGateways'));
    }

    /**
     * Process donation request
     */
    public function store(DonationRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create donation record
            $donation = Donation::create([
                'donor_name' => $request->donor_name,
                'donor_email' => $request->donor_email,
                'donor_phone' => $request->donor_phone,
                'amount' => $request->amount,
                'currency' => $request->currency,
                'purpose' => $request->purpose,
                'payment_method' => $request->payment_method,
                'notes' => $request->notes,
                'payment_status' => 'pending',
            ]);

            // Generate receipt number
            $donation->receipt_number = 'NGO-' . str_pad($donation->id, 6, '0', STR_PAD_LEFT) . '-' . date('Y');
            $donation->save();

            // Initiate payment
            $paymentService = $this->paymentManager->gateway($request->payment_method);
            $paymentResponse = $paymentService->initiatePayment([
                'amount' => $request->amount,
                'donor_name' => $request->donor_name,
                'donor_email' => $request->donor_email,
                'donor_phone' => $request->donor_phone,
                'purpose' => $request->purpose,
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

                return redirect()->route('donation.success')
                    ->with('success', 'Payment initiated successfully.');
            } else {
                DB::rollBack();
                
                return redirect()->back()
                    ->withInput()
                    ->with('error', $paymentResponse->errorMessage ?? 'Payment initiation failed.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Donation processing failed', [
                'error' => $e->getMessage(),
                'request_data' => $request->validated()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while processing your donation. Please try again.');
        }
    }

    /**
     * Handle successful payment callback
     */
    public function success(Request $request)
    {
        $transactionId = $request->get('oid') ?? $request->get('pidx');
        
        if (!$transactionId) {
            return redirect()->route('home')
                ->with('error', 'Invalid payment response.');
        }

        try {
            $donation = Donation::where('transaction_id', $transactionId)->first();
            
            if (!$donation) {
                return redirect()->route('home')
                    ->with('error', 'Donation record not found.');
            }

            // Verify payment with gateway
            $paymentService = $this->paymentManager->gateway($donation->payment_method);
            $verification = $paymentService->verifyPayment($transactionId);

            if ($verification->success && $verification->status === 'completed') {
                // Update donation status
                $donation->update([
                    'payment_status' => 'completed',
                    'verified_at' => now(),
                ]);

                // Generate and send receipt
                $receipt = $paymentService->generateReceipt($donation);
                
                // Send confirmation email (implement mail class)
                // Mail::to($donation->donor_email)->send(new DonationConfirmationMail($donation, $receipt));

                Log::info('Donation completed successfully', [
                    'donation_id' => $donation->id,
                    'transaction_id' => $transactionId,
                    'amount' => $donation->amount
                ]);

                return view('donations.success', compact('donation', 'receipt'));
            } else {
                $donation->update(['payment_status' => 'failed']);
                
                return redirect()->route('donation.create')
                    ->with('error', 'Payment verification failed. Please try again.');
            }

        } catch (\Exception $e) {
            Log::error('Payment verification failed', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('donation.create')
                ->with('error', 'Payment verification failed. Please contact support.');
        }
    }

    /**
     * Handle failed payment callback
     */
    public function failure(Request $request)
    {
        $transactionId = $request->get('oid') ?? $request->get('pidx');
        
        if ($transactionId) {
            $donation = Donation::where('transaction_id', $transactionId)->first();
            if ($donation) {
                $donation->update(['payment_status' => 'failed']);
            }
        }

        return redirect()->route('donation.create')
            ->with('error', 'Payment was cancelled or failed. Please try again.');
    }

    /**
     * Show donation details
     */
    public function show(Donation $donation)
    {
        return view('donations.show', compact('donation'));
    }

    /**
     * Download donation receipt
     */
    public function downloadReceipt(Donation $donation)
    {
        if ($donation->payment_status !== 'completed') {
            abort(404);
        }

        $paymentService = $this->paymentManager->gateway($donation->payment_method);
        $receipt = $paymentService->generateReceipt($donation);

        return response()->download($receipt->pdfPath);
    }
}