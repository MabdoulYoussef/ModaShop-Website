<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Performance Optimization Settings
    |--------------------------------------------------------------------------
    |
    | This file contains performance optimization settings for ModaShop
    |
    */

    'cache' => [
        'homepage' => [
            'featured_products' => 3600, // 1 hour
            'categories' => 7200, // 2 hours
            'latest_products' => 1800, // 30 minutes
        ],
        'admin' => [
            'dashboard_stats' => 900, // 15 minutes
            'recent_orders' => 300, // 5 minutes
            'low_stock_products' => 600, // 10 minutes
        ],
        'products' => [
            'category_list' => 3600, // 1 hour
            'product_list' => 1800, // 30 minutes
        ],
    ],

    'database' => [
        'indexes' => [
            'products' => ['stock', 'category_id', 'price', 'name'],
            'orders' => ['status', 'created_at', 'customer_id'],
            'categories' => ['name'],
            'customers' => ['phone', 'firstname', 'lastname'],
        ],
    ],

    'optimization' => [
        'enable_query_logging' => env('QUERY_LOGGING', false),
        'enable_slow_query_logging' => env('SLOW_QUERY_LOGGING', true),
        'slow_query_threshold' => env('SLOW_QUERY_THRESHOLD', 1000), // milliseconds
    ],
];

