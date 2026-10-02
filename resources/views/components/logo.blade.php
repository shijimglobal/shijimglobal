@props(['alt' => ''])

{{-- Horizontal brand logo: colored in light mode, white in dark mode. --}}
<img src="{{ asset('assets/logo/horiz_color.png') }}" alt="{{ $alt }}" {{ $attributes->class('w-auto dark:hidden') }}>
<img src="{{ asset('assets/logo/horiz_white.png') }}" alt="{{ $alt }}" {{ $attributes->class('hidden w-auto dark:block') }}>
