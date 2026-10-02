{{-- Search engine and link preview (Facebook, Messenger, Telegram, X) metadata. --}}
@php
    $shareTitle = __(config('company.name')).' — '.__(config('company.slogan'));
    $shareDescription = __('We build company websites and online stores, connect QR and card payments, and provide server setup and rental. More opportunities, lower costs.');
    $shareImage = asset('assets/og/og-image.png').'?v='.@filemtime(public_path('assets/og/og-image.png'));
    $currentLocale = app()->getLocale();
    $openGraphLocales = ['mn' => 'mn_MN', 'en' => 'en_US'];
@endphp

<meta name="description" content="{{ $shareDescription }}">
@if (filled(config('services.google.site_verification')))
    <meta name="google-site-verification" content="{{ config('services.google.site_verification') }}">
@endif
<link rel="canonical" href="{{ url()->current() }}">

@if (filled(config('services.facebook.app_id')))
    <meta property="fb:app_id" content="{{ config('services.facebook.app_id') }}">
@endif
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ __(config('company.name')) }}">
<meta property="og:title" content="{{ $shareTitle }}">
<meta property="og:description" content="{{ $shareDescription }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $shareImage }}">
<meta property="og:image:secure_url" content="{{ $shareImage }}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $shareTitle }}">
<meta property="og:locale" content="{{ $openGraphLocales[$currentLocale] ?? 'mn_MN' }}">
@foreach ($openGraphLocales as $localeCode => $openGraphLocale)
    @continue($localeCode === $currentLocale)
    <meta property="og:locale:alternate" content="{{ $openGraphLocale }}">
@endforeach

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $shareTitle }}">
<meta name="twitter:description" content="{{ $shareDescription }}">
<meta name="twitter:image" content="{{ $shareImage }}">
