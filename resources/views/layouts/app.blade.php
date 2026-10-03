<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="shijim">
<head>
    @include('partials.head', ['title' => $title ?? __('Website development service | Websites, online stores, server rental').' | '.__('Shijim Global')])
    @include('partials.social-meta')
    @include('partials.structured-data')
</head>
<body class="no-text-select bg-base-100 text-base-content font-sans antialiased transition-colors duration-300">
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @include('partials.messenger')
</body>
</html>
