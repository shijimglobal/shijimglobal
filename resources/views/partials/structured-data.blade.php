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

    // Page-specific entries: breadcrumbs plus Service, Article or FAQPage data.
    $faqPage = fn (array $questions): array => [
        '@type' => 'FAQPage',
        'mainEntity' => array_map(fn (array $faq): array => [
            '@type' => 'Question',
            'name' => $faq['question'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
        ], $questions),
    ];

    $breadcrumbTrail = [];

    if (isset($service)) {
        $breadcrumbTrail = [[$service['title'], $service['url']]];
        $structuredData['@graph'][] = [
            '@type' => 'Service',
            'name' => $service['title'],
            'description' => $service['seo_description'],
            'url' => $service['url'],
            'provider' => ['@id' => $organizationId],
            'areaServed' => ['@type' => 'Country', 'name' => 'Mongolia'],
        ];
        $structuredData['@graph'][] = $faqPage($service['faqs']);
    } elseif (isset($article)) {
        $breadcrumbTrail = [[__('Knowledge'), route('articles.index')], [$article['title'], $article['url']]];
        $structuredData['@graph'][] = [
            '@type' => 'Article',
            'headline' => $article['title'],
            'description' => $article['seo_description'],
            'url' => $article['url'],
            'image' => asset('assets/og/og-image.png'),
            'datePublished' => $article['published_at'],
            'inLanguage' => app()->getLocale(),
            'author' => ['@id' => $organizationId],
            'publisher' => ['@id' => $organizationId],
        ];
    } elseif (request()->routeIs('home')) {
        $structuredData['@graph'][] = $faqPage(\App\Support\SiteContent::faqs());
    } elseif (request()->routeIs('articles.index')) {
        $breadcrumbTrail = [[__('Knowledge'), route('articles.index')]];
    }

    if ($breadcrumbTrail !== []) {
        $structuredData['@graph'][] = [
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect([[__('Home'), $homeUrl], ...$breadcrumbTrail])
                ->values()
                ->map(fn (array $crumb, int $index): array => [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => trim($crumb[0]),
                    'item' => $crumb[1],
                ])
                ->all(),
        ];
    }
@endphp

<script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
