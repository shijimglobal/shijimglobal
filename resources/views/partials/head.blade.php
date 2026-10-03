<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $title }}</title>
<meta name="theme-color" content="#4b52ff">

<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
{{-- Google Search shows favicons whose size is a multiple of 48px. --}}
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/ico/favicon-192x192.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/ico/favicon-96x96.png') }}">
<link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/ico/favicon-48x48.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/ico/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/ico/favicon-16x16.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/ico/apple-touch-icon-padded.png') }}">
<link rel="manifest" href="{{ asset('assets/ico/site.webmanifest') }}">

<script>
    (() => {
        document.documentElement.classList.add('js');

        try {
            const storedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = storedTheme ? storedTheme === 'dark' : prefersDark;
            document.documentElement.dataset.theme = isDark ? 'shijim-dark' : 'shijim';
        } catch (error) {}
    })();
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'])
