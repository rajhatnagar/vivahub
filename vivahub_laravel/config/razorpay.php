<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Razorpay Payment Gateway Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Razorpay payment gateway. These values are loaded
    | dynamically from the database settings table.
    |
    */

    'key' => env('RAZORPAY_KEY', ''),
    'secret' => env('RAZORPAY_SECRET', ''),
    
    // Currency for payments
    'currency' => 'INR',
    
    // Credit packages available for purchase
    'packages' => [
        [
            'id' => 'pack_10',
            'credits' => 10,
            'price' => 5000, // in paise (₹50)
            'name' => '10 Credits Pack',
        ],
        [
            'id' => 'pack_25',
            'credits' => 25,
            'price' => 10000, // in paise (₹100)
            'name' => '25 Credits Pack',
        ],
        [
            'id' => 'pack_50',
            'credits' => 50,
            'price' => 17500, // in paise (₹175)
            'name' => '50 Credits Pack',
        ],
    ],
];
