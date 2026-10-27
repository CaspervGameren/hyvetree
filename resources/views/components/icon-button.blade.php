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
        hover:border-[#4CFC93]/60 hover:bg-[#4CFC93]/15 hover:text-[#4CFC93]
        active:border-[#4CFC93] active:bg-[#4CFC93]/20 active:text-[#4CFC93]
        aria-[current=page]:border-[#4CFC93]/60 aria-[current=page]:bg-[#4CFC93]/15 aria-[current=page]:text-[#4CFC93]
        active:scale-95
        focus-visible:outline-2 focus-visible:outline-offset-4
        focus-visible:outline-[#4CFC93]';
@endphp

<span class="group relative inline-flex">
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
    <span aria-hidden="true"
          class="pointer-events-none absolute left-full top-1/2 z-50 ml-3 -translate-y-1/2
                 whitespace-nowrap rounded-lg border border-white/15 bg-neutral-900 px-3 py-2
                 text-xs font-medium text-white/90 shadow-xl
                 invisible opacity-0 transition-[opacity,visibility] duration-150 delay-0
                 group-hover:visible group-hover:opacity-100 group-hover:delay-1000
                 group-focus-within:visible group-focus-within:opacity-100 group-focus-within:delay-0">
        {{ $label }}
    </span>
</span>
