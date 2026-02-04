<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Payment Gateway Services
    |--------------------------------------------------------------------------
    |
    | Configuration for payment gateways used in the NGO website
    |
    */

    'esewa' => [
        'merchant_id' => env('ESEWA_MERCHANT_ID'),
        'secret_key' => env('ESEWA_SECRET_KEY'),
        'success_url' => env('ESEWA_SUCCESS_URL'),
        'failure_url' => env('ESEWA_FAILURE_URL'),
        'test_mode' => env('ESEWA_TEST_MODE', true),
        'api_url' => env('ESEWA_API_URL', 'https://uat.esewa.com.np/epay/main'),
    ],

    'khalti' => [
        'public_key' => env('KHALTI_PUBLIC_KEY'),
        'secret_key' => env('KHALTI_SECRET_KEY'),
        'success_url' => env('KHALTI_SUCCESS_URL'),
        'failure_url' => env('KHALTI_FAILURE_URL'),
        'test_mode' => env('KHALTI_TEST_MODE', true),
        'api_url' => env('KHALTI_API_URL', 'https://khalti.com/api/v2/'),
    ],

];