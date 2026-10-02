{{-- schema.org data that helps Google show the company name, logo, contacts and services in search results. --}}
@php
    $homeUrl = route('home');
    $organizationId = $homeUrl.'#organization';
    $postalAddress = [
        '@type' => 'PostalAddress',
        'addressLocality' => __('Ulaanbaatar'),
        'addressCountry' => 'MN',
    ];

    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => $organizationId,
                'name' => __(config('company.name')),
                'alternateName' => ['Shijim Global', 'Шижим Глобал'],
                'url' => $homeUrl,
                'logo' => asset('assets/ico/icon-512.png'),
                'email' => config('company.email'),
                'telephone' => config('company.phone'),
                'address' => $postalAddress,
                'sameAs' => array_values(array_filter([config('company.facebook')])),
            ],
            [
                '@type' => 'WebSite',
                '@id' => $homeUrl.'#website',
                'url' => $homeUrl,
                'name' => __(config('company.name')),
                'inLanguage' => app()->getLocale(),
                'publisher' => ['@id' => $organizationId],
            ],
            [
                '@type' => 'ProfessionalService',
                '@id' => $homeUrl.'#service',
                'name' => __(config('company.name')),
                'description' => __('Company websites, online payments, e-commerce solutions, server setup and server rental services.'),
                'url' => $homeUrl,
                'image' => asset('assets/og/og-image.png'),
                'email' => config('company.email'),
                'telephone' => config('company.phone'),
                'address' => $postalAddress,
                'areaServed' => ['@type' => 'Country', 'name' => 'Mongolia'],
                'slogan' => __(config('company.slogan')),
                'parentOrganization' => ['@id' => $organizationId],
                'hasOfferCatalog' => [
                    '@type' => 'OfferCatalog',
                    'name' => __('Services'),
                    'itemListElement' => collect(\App\Http\Requests\StoreContactRequest::SERVICES)
                        ->reject(fn (string $serviceName): bool => $serviceName === 'Other')
                        ->map(fn (string $serviceName): array => [
                            '@type' => 'Offer',
                            'itemOffered' => ['@type' => 'Service', 'name' => __($serviceName)],
                        ])
                        ->values()
                        ->all(),
                ],
            ],
        ],
    ];
@endphp

<script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
