<?php

namespace App\Services\Payment;

use App\Contracts\PaymentServiceInterface;
use App\Contracts\PaymentResponse;
use App\Contracts\PaymentVerification;
use App\Contracts\Receipt;
use App\Models\Donation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KhaltiPaymentService implements PaymentServiceInterface
{
    private string $publicKey;
    private string $secretKey;
    private string $baseUrl;
    private bool $isProduction;

    public function __construct()
    {
        $this->publicKey = config('services.khalti.public_key');
        $this->secretKey = config('services.khalti.secret_key');
        $this->isProduction = config('services.khalti.production', false);
        $this->baseUrl = $this->isProduction 
            ? 'https://khalti.com/api/v2'
            : 'https://a.khalti.com/api/v2';
    }

    public function initiatePayment(array $paymentData): PaymentResponse
    {
        try {
            $transactionId = 'NGO-KHL-' . time() . '-' . rand(1000, 9999);
            
            $payload = [
                'return_url' => route('donation.khalti.callback'),
                'website_url' => config('app.url'),
                'amount' => $paymentData['amount'] * 100, // Khalti expects amount in paisa
                'purchase_order_id' => $transactionId,
                'purchase_order_name' => 'Donation to ' . config('app.name'),
                'customer_info' => [
                    'name' => $paymentData['donor_name'],
                    'email' => $paymentData['donor_email'],
                    'phone' => $paymentData['donor_phone'] ?? '',
                ],
                'product_details' => [
                    [
                        'identity' => $paymentData['purpose'],
                        'name' => ucfirst(str_replace('_', ' ', $paymentData['purpose'])),
                        'total_price' => $paymentData['amount'] * 100,
                        'quantity' => 1,
                        'unit_price' => $paymentData['amount'] * 100,
                    ]
                ],
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Key ' . $this->secretKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/epayment/initiate/', $payload);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Khalti payment initiated', [
                    'transaction_id' => $transactionId,
                    'amount' => $paymentData['amount'],
                    'donor_email' => $paymentData['donor_email'],
                    'pidx' => $data['pidx'] ?? null
                ]);

                return new PaymentResponse(
                    success: true,
                    transactionId: $transactionId,
                    redirectUrl: $data['payment_url'] ?? null,
                    data: $data
                );
            }

            Log::error('Khalti payment initiation failed', [
                'response' => $response->body(),
                'status' => $response->status()
            ]);

            return new PaymentResponse(
                success: false,
                errorMessage: 'Payment initiation failed. Please try again.'
            );

        } catch (\Exception $e) {
            Log::error('Khalti payment initiation error', [
                'error' => $e->getMessage(),
                'payment_data' => $paymentData
            ]);

            return new PaymentResponse(
                success: false,
                errorMessage: 'Payment service unavailable. Please try again later.'
            );
        }
    }

    public function verifyPayment(string $transactionId): PaymentVerification
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Key ' . $this->secretKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/epayment/lookup/', [
                'pidx' => $transactionId
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['status']) && $data['status'] === 'Completed') {
                    Log::info('Khalti payment verified successfully', [
                        'transaction_id' => $transactionId,
                        'response' => $data
                    ]);

                    return new PaymentVerification(
                        success: true,
                        status: 'completed',
                        amount: ($data['total_amount'] ?? 0) / 100, // Convert from paisa to rupees
                        transactionId: $transactionId,
                        data: $data
                    );
                }
            }

            Log::warning('Khalti payment verification failed', [
                'transaction_id' => $transactionId,
                'response' => $response->body()
            ]);

            return new PaymentVerification(
                success: false,
                status: 'failed',
                transactionId: $transactionId,
                errorMessage: 'Payment verification failed'
            );

        } catch (\Exception $e) {
            Log::error('Khalti payment verification error', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage()
            ]);

            return new PaymentVerification(
                success: false,
                status: 'error',
                transactionId: $transactionId,
                errorMessage: 'Payment verification error'
            );
        }
    }

    public function generateReceipt(Donation $donation): Receipt
    {
        $receiptNumber = 'KHL-' . $donation->id . '-' . date('Ymd');
        
        // Generate PDF receipt (implementation would use a PDF library)
        $pdfPath = storage_path('app/receipts/' . $receiptNumber . '.pdf');
        
        return new Receipt(
            receiptNumber: $receiptNumber,
            donorName: $donation->donor_name,
            amount: $donation->amount,
            purpose: $donation->purpose,
            date: $donation->created_at->format('Y-m-d H:i:s'),
            transactionId: $donation->transaction_id,
            pdfPath: $pdfPath
        );
    }

    public function getGatewayName(): string
    {
        return 'Khalti';
    }

    public function isAvailable(): bool
    {
        return !empty($this->publicKey) && !empty($this->secretKey);
    }
}