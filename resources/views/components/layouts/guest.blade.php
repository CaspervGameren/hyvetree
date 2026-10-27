@props(['title' => 'Welcome'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hyvetree - {{ $title }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-neutral-950 p-4 text-white sm:p-6">
    <header class="flex items-center justify-between gap-4 rounded-2xl border border-white/15 bg-linear-to-b from-white/10 to-white/3 px-5 py-4 shadow-[inset_0_1px_0_rgba(255,255,255,0.15)] backdrop-blur-2xl">
        <a href="/" class="rounded text-sm font-medium text-white/80 transition hover:text-[#4CFC93] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Hyvetree</a>
        <a href="/" class="flex items-center gap-2 rounded text-xs text-neutral-400 transition hover:text-[#4CFC93] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]"><span class="material-icons-outlined text-base!" aria-hidden="true">arrow_back</span>Back to home</a>
    </header>
    <main class="flex flex-1 items-center justify-center px-1 py-12 sm:py-16">
        <div class="w-full max-w-md rounded-3xl border border-white/15 bg-linear-to-br from-white/8 to-white/2 p-6 shadow-[inset_0_1px_0_rgba(255,255,255,0.1),0_24px_80px_rgba(0,0,0,0.3)] sm:p-9">
            {{ $slot }}
        </div>
    </main>
    <footer class="pb-2 text-center text-xs text-neutral-600">A little space for your next big idea.</footer>
</body>
</html>
