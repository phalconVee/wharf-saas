<?php

return [
    /**
     * List of payment methods.
     */

    'manual' => [
        'is_active' => env('MANUAL_PAYMENT_IS_ACTIVE', true),
        'name' => 'Manual Payment',
        'identifier' => 'manual',
        'description' => 'Manual Payment',
        'note' => env('MANUAL_PAYMENT_NOTE'),
    ],

    'stripe' => [
        'is_active' => env('STRIPE_IS_ACTIVE', true),
        'name' => 'Stripe',
        'identifier' => 'stripe',
        'description' => 'Stripe Payment Gateway',

        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
    ],

    'paypal' => [
        'is_active' => env('PAYPAL_IS_ACTIVE', true),
        'name' => 'Paypal',
        'identifier' => 'paypal',
        'description' => 'Paypal Payment Gateway',
    ],
];
