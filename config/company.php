<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Company Profile
    |--------------------------------------------------------------------------
    |
    | Public contact details shown across the marketing website. The name,
    | slogan and address are translation keys resolved with __().
    |
    */

    'name' => 'Shijim Global LLC',

    'slogan' => 'More opportunities, lower costs',

    'email' => env('COMPANY_EMAIL', 'info@shijimglobal.mn'),

    'phone' => env('COMPANY_PHONE', '+976 9920 1210 '),

    'address' => env('COMPANY_ADDRESS', 'Ulaanbaatar, Mongolia'),

    'messenger' => env('COMPANY_MESSENGER', 'https://m.me/shijimglobal'),

    /*
    |--------------------------------------------------------------------------
    | Supported Locales
    |--------------------------------------------------------------------------
    |
    | Languages visitors can switch between, keyed by locale code.
    |
    */

    'locales' => [
        'mn' => 'Монгол',
        'en' => 'English',
    ],

];
