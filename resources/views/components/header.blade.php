@props(['title', 'backUrl' => null])

<header>
    @if($backUrl)
        <a href="{{ $backUrl }}">%larr; Backk</a>
    @endif

    <h1 class="font-bold text-4xl">{{ $title }}</h1>

    {{ $slot }}
</header>