<?php

namespace App\Providers;

use App\Services\Payment\EsewaPaymentService;
use App\Services\Payment\KhaltiPaymentService;
use App\Services\Payment\PaymentServiceInterface;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register payment service interfaces
        $this->app->bind('payment.esewa', function ($app) {
            return new EsewaPaymentService(
                config('services.esewa.merchant_id'),
                config('services.esewa.secret_key'),
                config('services.esewa.success_url'),
                config('services.esewa.failure_url')
            );
        });

        $this->app->bind('payment.khalti', function ($app) {
            return new KhaltiPaymentService(
                config('services.khalti.public_key'),
                config('services.khalti.secret_key'),
                config('services.khalti.success_url'),
                config('services.khalti.failure_url')
            );
        });

        // Default payment service (eSewa)
        $this->app->bind(PaymentServiceInterface::class, function ($app) {
            return $app->make('payment.esewa');
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish payment configuration
        $this->publishes([
            __DIR__.'/../../config/services.php' => config_path('services.php'),
        ], 'ngo-payment-config');
    }
}