@props([
    'icon',
    'label',
    'href' => null,
])

@php
    $classes = 'inline-flex h-12 w-12 shrink-0 items-center justify-center
        rounded-2xl border border-white/15
        bg-gradient-to-b from-white/15 to-white/5
        text-white/80 shadow-lg backdrop-blur-xl
        transition duration-200
        hover:border-white/30 hover:bg-white/15 hover:text-white
        active:scale-95
        focus-visible:outline-2 focus-visible:outline-offset-4
        focus-visible:outline-white/60';
@endphp

@if ($href)
    <a href="{{ $href }}"
       aria-label="{{ $label }}"
       {{ $attributes->class([$classes]) }}>
        <span class="material-icons-outlined" aria-hidden="true">{{ $icon }}</span>
    </a>
@else
    <button type="button"
            aria-label="{{ $label }}"
            {{ $attributes->class([$classes]) }}>
        <span class="material-icons-outlined" aria-hidden="true">{{ $icon }}</span>
    </button>
@endif