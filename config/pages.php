<?php

/*
|--------------------------------------------------------------------------
| Site Pages
|--------------------------------------------------------------------------
|
| Language-independent settings for the service and knowledge pages. The
| texts for each key live in lang/{locale}/pages.php.
|
*/

return [

    'services' => [
        'web' => [
            'slug' => 'website-development',
            'legacy_slug' => 'veb-sait-hiih',
            'icon' => 'icon-[tabler--world-www]',
            'contact_service' => 'Company website',
            'article' => 'what-is-a-website',
        ],
        'payments' => [
            'slug' => 'online-payments',
            'legacy_slug' => 'onlain-tolbor',
            'icon' => 'icon-[tabler--credit-card-pay]',
            'contact_service' => 'Online payments',
            'article' => 'qpay-integration',
        ],
        'ecommerce' => [
            'slug' => 'e-commerce',
            'legacy_slug' => 'onlain-delguur',
            'icon' => 'icon-[tabler--shopping-bag]',
            'contact_service' => 'E-commerce',
            'article' => 'qpay-integration',
        ],
        'server-setup' => [
            'slug' => 'server-setup',
            'legacy_slug' => 'server-tohirgoo',
            'icon' => 'icon-[tabler--server-cog]',
            'contact_service' => 'Server setup',
            'article' => 'server-and-vps',
        ],
        'server-rental' => [
            'slug' => 'server-rental',
            'legacy_slug' => 'server-turees',
            'icon' => 'icon-[tabler--cloud-computing]',
            'contact_service' => 'Server rental',
            'article' => 'server-and-vps',
        ],
    ],

    'articles' => [
        'what-is-a-website' => [
            'slug' => 'what-is-a-website',
            'legacy_slug' => 'veb-sait-gej-yu-ve',
            'watermark' => 'WEB',
            'icon' => 'icon-[tabler--world-www]',
            'service' => 'web',
            'published_at' => '2026-10-03',
        ],
        'server-and-vps' => [
            'slug' => 'servers-and-vps',
            'legacy_slug' => 'server-vps-gej-yu-ve',
            'watermark' => 'VPS',
            'icon' => 'icon-[tabler--server-2]',
            'service' => 'server-rental',
            'published_at' => '2026-10-03',
        ],
        'qpay-integration' => [
            'slug' => 'qpay-integration',
            'legacy_slug' => 'qpay-holboh',
            'watermark' => 'QR PAY',
            'icon' => 'icon-[tabler--qrcode]',
            'service' => 'payments',
            'published_at' => '2026-10-03',
        ],
    ],

];
