<?php
declare(strict_types=1);

return [
    'smaregi_api_host' => [
        'idp' => env('SMAREGI_ID_HOST', ''),
        'pos' => env('SMAREGI_POS_HOST', ''),
    ],
    'webhook_header' => [
        'key' => env('WEBHOOK_HEADER_KEY', ''),
        'value' => env('WEBHOOK_HEADER_VALUE', ''),
    ],
    'client_id' => env('SMAREGI_CLIENT_ID', ''),
    'client_secret' => env('SMAREGI_CLIENT_SECRET', ''),
    'scopes' => [
        'pos.products:read',
        'pos.customers:read',
        'pos.transactions:read',
        'pos.stores:read',
        'pos.staffs:read',
    ],
    'webhooks' => [
        'customer' => 'pos:categories',
    ],
    'providers' => [
        'smaregi' => 'smaregi',
    ],
];
