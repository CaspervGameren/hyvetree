@props([
    'title' => 'Page',
    'showSidebar' => true,
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - {{ $title }}</title>

    <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">

    <x-theme-init />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen bg-neutral-950 light:bg-slate-50 text-white light:text-neutral-900 p-4">
    @include('partials.navigation')
    
    <div class="flex flex-1 items-stretch gap-4">
        @if ($showSidebar)
            @include('partials.sidebar')
        @endif

        <main class="min-w-0 flex-1">
            <x-feedback />
            {{ $slot }}
        </main>
    </div>
    
</body>
</html> 