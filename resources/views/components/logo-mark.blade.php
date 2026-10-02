@props(['alt' => ''])

{{-- Brand symbol: colored in light mode, white in dark mode. --}}
<img src="{{ asset('assets/logo/Asset 5.png') }}" alt="{{ $alt }}" {{ $attributes->class('dark:hidden') }}>
<img src="{{ asset('assets/logo/Asset 6.png') }}" alt="{{ $alt }}" {{ $attributes->class('hidden dark:block') }}>
