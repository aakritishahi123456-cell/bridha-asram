<?php

namespace App\Services\Payment;

use App\Contracts\PaymentServiceInterface;
use InvalidArgumentException;

class PaymentManager
{
    private array $gateways = [];

    public function __construct()
    {
        $this->registerGateways();
    }

    /**
     * Register available payment gateways
     */
    private function registerGateways(): void
    {
        $this->gateways = [
            'esewa' => ESewaPaymentService::class,
            'khalti' => KhaltiPaymentService::class,
        ];
    }

    /**
     * Get payment service instance for a specific gateway
     */
    public function gateway(string $gateway): PaymentServiceInterface
    {
        if (!isset($this->gateways[$gateway])) {
            throw new InvalidArgumentException("Payment gateway '{$gateway}' is not supported.");
        }

        $serviceClass = $this->gateways[$gateway];
        $service = new $serviceClass();

        if (!$service->isAvailable()) {
            throw new InvalidArgumentException("Payment gateway '{$gateway}' is not properly configured.");
        }

        return $service;
    }

    /**
     * Get all available payment gateways
     */
    public function getAvailableGateways(): array
    {
        $available = [];

        foreach ($this->gateways as $name => $class) {
            $service = new $class();
            if ($service->isAvailable()) {
                $available[$name] = $service->getGatewayName();
            }
        }

        return $available;
    }

    /**
     * Check if a gateway is available
     */
    public function isGatewayAvailable(string $gateway): bool
    {
        if (!isset($this->gateways[$gateway])) {
            return false;
        }

        $service = new $this->gateways[$gateway]();
        return $service->isAvailable();
    }
}