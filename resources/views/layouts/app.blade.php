<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="shijim">
<head>
    @include('partials.head', ['title' => $title ?? __(config('company.name')).' — '.__(config('company.slogan'))])
    <meta name="description" content="{{ __('Company websites, online payments, e-commerce solutions, server setup and server rental services.') }}">
</head>
<body class="bg-base-100 text-base-content font-sans antialiased transition-colors duration-300">
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @include('partials.messenger')
</body>
</html>
