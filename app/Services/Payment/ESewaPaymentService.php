<?php

namespace App\Services\Payment;

use App\Contracts\PaymentServiceInterface;
use App\Contracts\PaymentResponse;
use App\Contracts\PaymentVerification;
use App\Contracts\Receipt;
use App\Models\Donation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ESewaPaymentService implements PaymentServiceInterface
{
    private string $merchantCode;
    private string $secretKey;
    private string $baseUrl;
    private bool $isProduction;

    public function __construct()
    {
        $this->merchantCode = config('services.esewa.merchant_code');
        $this->secretKey = config('services.esewa.secret_key');
        $this->isProduction = config('services.esewa.production', false);
        $this->baseUrl = $this->isProduction 
            ? 'https://epay.esewa.com.np/api/epay/main/v2/form'
            : 'https://uat.esewa.com.np/epay/main';
    }

    public function initiatePayment(array $paymentData): PaymentResponse
    {
        try {
            $transactionId = 'NGO-' . time() . '-' . rand(1000, 9999);
            
            $params = [
                'amt' => $paymentData['amount'],
                'pdc' => 0,
                'psc' => 0,
                'txAmt' => $paymentData['amount'],
                'tAmt' => $paymentData['amount'],
                'pid' => $transactionId,
                'scd' => $this->merchantCode,
                'su' => route('donation.success'),
                'fu' => route('donation.failure'),
            ];

            // Generate signature for security
            $signature = $this->generateSignature($params);
            $params['signature'] = $signature;

            $redirectUrl = $this->baseUrl . '?' . http_build_query($params);

            Log::info('eSewa payment initiated', [
                'transaction_id' => $transactionId,
                'amount' => $paymentData['amount'],
                'donor_email' => $paymentData['donor_email']
            ]);

            return new PaymentResponse(
                success: true,
                transactionId: $transactionId,
                redirectUrl: $redirectUrl,
                data: $params
            );

        } catch (\Exception $e) {
            Log::error('eSewa payment initiation failed', [
                'error' => $e->getMessage(),
                'payment_data' => $paymentData
            ]);

            return new PaymentResponse(
                success: false,
                errorMessage: 'Payment initiation failed. Please try again.'
            );
        }
    }

    public function verifyPayment(string $transactionId): PaymentVerification
    {
        try {
            $verificationUrl = $this->isProduction
                ? 'https://epay.esewa.com.np/api/epay/transaction/status/'
                : 'https://uat.esewa.com.np/epay/transrec';

            $response = Http::timeout(30)->get($verificationUrl, [
                'pid' => $transactionId,
                'scd' => $this->merchantCode,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['status']) && $data['status'] === 'COMPLETE') {
                    Log::info('eSewa payment verified successfully', [
                        'transaction_id' => $transactionId,
                        'response' => $data
                    ]);

                    return new PaymentVerification(
                        success: true,
                        status: 'completed',
                        amount: $data['total_amount'] ?? null,
                        transactionId: $transactionId,
                        data: $data
                    );
                }
            }

            Log::warning('eSewa payment verification failed', [
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
            Log::error('eSewa payment verification error', [
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
        $receiptNumber = 'ESW-' . $donation->id . '-' . date('Ymd');
        
        // Generate PDF receipt (implementation would use a PDF library)
        $pdfPath = storage_path('app/receipts/' . $receiptNumber . '.pdf');
        
        // This would be implemented with a PDF generation library like DomPDF or TCPDF
        // For now, we'll just create a placeholder
        
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
        return 'eSewa';
    }

    public function isAvailable(): bool
    {
        return !empty($this->merchantCode) && !empty($this->secretKey);
    }

    private function generateSignature(array $params): string
    {
        $signatureString = sprintf(
            "total_amount=%s,transaction_uuid=%s,product_code=%s",
            $params['tAmt'],
            $params['pid'],
            $this->merchantCode
        );

        return base64_encode(hash_hmac('sha256', $signatureString, $this->secretKey, true));
    }
}