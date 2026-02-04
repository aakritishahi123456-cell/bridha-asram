<?php

namespace App\Contracts;

use App\Models\Donation;

interface PaymentServiceInterface
{
    /**
     * Initiate a payment transaction
     *
     * @param array $paymentData
     * @return PaymentResponse
     */
    public function initiatePayment(array $paymentData): PaymentResponse;

    /**
     * Verify a payment transaction
     *
     * @param string $transactionId
     * @return PaymentVerification
     */
    public function verifyPayment(string $transactionId): PaymentVerification;

    /**
     * Generate receipt for a donation
     *
     * @param Donation $donation
     * @return Receipt
     */
    public function generateReceipt(Donation $donation): Receipt;

    /**
     * Get payment gateway name
     *
     * @return string
     */
    public function getGatewayName(): string;

    /**
     * Check if payment method is available
     *
     * @return bool
     */
    public function isAvailable(): bool;
}

class PaymentResponse
{
    public function __construct(
        public bool $success,
        public ?string $transactionId = null,
        public ?string $redirectUrl = null,
        public ?string $errorMessage = null,
        public array $data = []
    ) {}
}

class PaymentVerification
{
    public function __construct(
        public bool $success,
        public string $status,
        public ?float $amount = null,
        public ?string $transactionId = null,
        public ?string $errorMessage = null,
        public array $data = []
    ) {}
}

class Receipt
{
    public function __construct(
        public string $receiptNumber,
        public string $donorName,
        public float $amount,
        public string $purpose,
        public string $date,
        public string $transactionId,
        public string $pdfPath
    ) {}
}