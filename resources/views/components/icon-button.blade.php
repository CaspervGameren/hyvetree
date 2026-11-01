@props([
    'icon',
    'label',
    'href' => null,
    'disabled' => false,
])

@php
    $classes = 'inline-flex h-12 w-12 shrink-0 items-center justify-center
        rounded-2xl border border-white/15 light:border-neutral-300/70
        bg-gradient-to-b from-white/15 light:from-white/90 to-white/5 light:to-white/40
        text-white/80 light:text-neutral-700 shadow-lg backdrop-blur-xl
        transition duration-200';

    $interactionClasses = 'hover:border-[#4CFC93]/60 light:hover:border-emerald-600/60 hover:bg-[#4CFC93]/15 hover:text-[#4CFC93] light:hover:text-emerald-700
        active:border-[#4CFC93] active:bg-[#4CFC93]/20 active:text-[#4CFC93] light:active:text-emerald-700
        aria-[current=page]:border-[#4CFC93]/60 light:aria-[current=page]:border-emerald-600/60 aria-[current=page]:bg-[#4CFC93]/15 aria-[current=page]:text-[#4CFC93] light:aria-[current=page]:text-emerald-700
        active:scale-95
        focus-visible:outline-2 focus-visible:outline-offset-4
        focus-visible:outline-[#4CFC93]';

    $classes .= $disabled
        ? ' cursor-not-allowed opacity-45 grayscale'
        : ' '.$interactionClasses;
@endphp

<span class="group relative inline-flex">
@if ($href && ! $disabled)
    <a href="{{ $href }}"
       aria-label="{{ $label }}"
       {{ $attributes->class([$classes]) }}>
        <span class="material-icons-outlined" aria-hidden="true">{{ $icon }}</span>
    </a>
@else
    <button type="button"
            @disabled($disabled)
            aria-label="{{ $label }}"
            {{ $attributes->class([$classes]) }}>
        <span class="material-icons-outlined" aria-hidden="true">{{ $icon }}</span>
    </button>
@endif
    <span aria-hidden="true"
          class="pointer-events-none absolute left-full top-1/2 z-50 ml-3 -translate-y-1/2
                 whitespace-nowrap rounded-lg border border-white/15 light:border-neutral-300/70 bg-neutral-900 light:bg-white px-3 py-2
                 text-xs font-medium text-white/90 light:text-neutral-700 shadow-xl
                 invisible opacity-0 transition-[opacity,visibility] duration-150 delay-0
                 group-hover:visible group-hover:opacity-100 group-hover:delay-1000
                 group-focus-within:visible group-focus-within:opacity-100 group-focus-within:delay-0">
        {{ $label }}
    </span>
</span>
