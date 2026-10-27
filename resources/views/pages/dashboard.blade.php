<x-layouts.app title="Dashboard">
    <div class="space-y-6">
        <header class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-4xl font-bold tracking-tight">Welcome, {{ auth()->user()->name }}.</h1>
                <p class="mt-3 text-sm leading-6 text-neutral-400">A little focus for the things you want to build. Where will you start today?</p>
            </div>
            <a href="{{ route('projects.create') }}"
               class="inline-flex w-fit shrink-0 items-center gap-2 rounded-xl bg-[#4CFC93] px-5 py-3 text-sm font-semibold text-neutral-950 transition hover:bg-[#79fdae] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">
                <span class="material-icons-outlined text-xl!" aria-hidden="true">add</span>New project
            </a>
        </header>

        <div class="grid items-start gap-6 xl:grid-cols-[minmax(0,1fr)_20rem]">
            <div class="min-w-0 space-y-6">
                <section class="relative overflow-hidden rounded-2xl border border-white/10 bg-linear-to-br from-[#4CFC93]/10 via-white/4 to-white/2 p-6 sm:p-8" aria-labelledby="workspace-heading">
                    <div class="pointer-events-none absolute -right-16 -top-20 h-64 w-64 rounded-full bg-[#4CFC93]/8 blur-3xl" aria-hidden="true"></div>
                    <div class="relative flex flex-col items-start justify-between gap-8 sm:flex-row">
                        <div class="max-w-xl">
                            <h2 id="workspace-heading" class="text-2xl font-semibold tracking-tight">Your next idea has a home.</h2>
                            <p class="mt-3 text-sm leading-7 text-neutral-400">A side project, something for school, or a skill you want to learn. Give it a name, set a direction, and take the next small step.</p>
                            <a href="{{ route('projects.create') }}" class="mt-6 inline-flex items-center gap-2 rounded text-sm font-medium text-[#4CFC93] transition hover:text-[#79fdae] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Start something new<span class="material-icons-outlined text-lg!" aria-hidden="true">arrow_forward</span></a>
                        </div>
                        <span class="material-icons-outlined shrink-0 rounded-2xl border border-[#4CFC93]/20 bg-[#4CFC93]/10 p-5 text-5xl! text-[#4CFC93] shadow-[inset_0_1px_0_rgba(76,252,147,0.12)]" aria-hidden="true">eco</span>
                    </div>
                </section>

                <section aria-labelledby="projects-heading" class="rounded-2xl border border-white/10 bg-linear-to-br from-white/5 to-white/2 p-6 sm:p-8">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <h2 id="projects-heading" class="text-lg font-semibold">Your projects</h2>
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 rounded text-xs font-medium text-neutral-400 transition hover:text-[#4CFC93] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">View all<span class="material-icons-outlined text-base!" aria-hidden="true">arrow_forward</span></a>
                    </div>
                    {{-- Add project cards here when the dashboard receives project data. --}}
                    <div class="mt-6 flex flex-col items-start gap-5 rounded-xl border border-white/10 bg-neutral-950/35 p-5 sm:flex-row sm:items-center sm:p-6">
                        <span class="material-icons-outlined rounded-xl border border-white/10 bg-white/5 p-3 text-3xl! text-neutral-400" aria-hidden="true">folder_open</span>
                        <div class="flex-1"><h3 class="text-sm font-medium">Find your next step.</h3><p class="mt-2 max-w-lg text-sm leading-6 text-neutral-500">Open your project overview to browse what you’re building, or make room for a new idea.</p></div>
                        <a href="{{ route('projects.index') }}" class="inline-flex shrink-0 items-center gap-2 rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-xs font-medium text-neutral-300 transition hover:border-[#4CFC93]/40 hover:bg-[#4CFC93]/5 hover:text-[#4CFC93] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Open projects<span class="material-icons-outlined text-base!" aria-hidden="true">arrow_outward</span></a>
                    </div>
                </section>

                <div class="grid gap-4 sm:grid-cols-2">
                    <a href="{{ route('projects.create') }}" class="group flex items-start gap-4 rounded-2xl border border-white/10 bg-white/3 p-5 transition hover:border-[#4CFC93]/30 hover:bg-[#4CFC93]/5 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">
                        <span class="material-icons-outlined rounded-xl bg-white/5 p-2.5 text-neutral-400 transition group-hover:text-[#4CFC93]" aria-hidden="true">create_new_folder</span>
                        <div class="flex-1"><h2 class="text-sm font-medium">Capture an idea</h2><p class="mt-2 text-xs leading-5 text-neutral-500">Turn that “what if” into a project.</p></div>
                        <span class="material-icons-outlined text-lg! text-neutral-600 transition group-hover:text-[#4CFC93]" aria-hidden="true">north_east</span>
                    </a>
                    <a href="{{ route('projects.index') }}" class="group flex items-start gap-4 rounded-2xl border border-white/10 bg-white/3 p-5 transition hover:border-[#4CFC93]/30 hover:bg-[#4CFC93]/5 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">
                        <span class="material-icons-outlined rounded-xl bg-white/5 p-2.5 text-neutral-400 transition group-hover:text-[#4CFC93]" aria-hidden="true">dashboard</span>
                        <div class="flex-1"><h2 class="text-sm font-medium">See the bigger picture</h2><p class="mt-2 text-xs leading-5 text-neutral-500">Head to your project overview.</p></div>
                        <span class="material-icons-outlined text-lg! text-neutral-600 transition group-hover:text-[#4CFC93]" aria-hidden="true">north_east</span>
                    </a>
                </div>
            </div>

            <section class="rounded-2xl border border-white/10 bg-linear-to-b from-white/6 to-white/2 p-6" aria-labelledby="starting-heading">
                <h2 id="starting-heading" class="text-base font-semibold">A good place to start</h2>
                <p class="mt-2 text-xs leading-6 text-neutral-500">Keep the plan simple. Give yourself something to come back to.</p>
                <ol class="mt-6 space-y-6">
                    <li class="flex gap-3"><span class="inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-lg border border-[#4CFC93]/20 bg-[#4CFC93]/10 text-xs font-medium text-[#4CFC93]">1</span><div><h3 class="text-sm font-medium text-neutral-300">Give it a name</h3><p class="mt-1 text-xs leading-6 text-neutral-500">Start with the idea. The details can grow from there.</p></div></li>
                    <li class="flex gap-3"><span class="inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-xs font-medium text-neutral-400">2</span><div><h3 class="text-sm font-medium text-neutral-300">Set your direction</h3><p class="mt-1 text-xs leading-6 text-neutral-500">Write down what you want to achieve and choose a starting status.</p></div></li>
                    <li class="flex gap-3"><span class="inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-xs font-medium text-neutral-400">3</span><div><h3 class="text-sm font-medium text-neutral-300">Make it yours</h3><p class="mt-1 text-xs leading-6 text-neutral-500">Choose an icon, add dates if you need them, and decide who can see it.</p></div></li>
                </ol>
                <div class="mt-7 flex items-center gap-2 border-t border-white/10 pt-5 text-xs text-neutral-500"><span class="material-icons-outlined text-base! text-[#4CFC93]/70" aria-hidden="true">spa</span>Small steps. Room to grow.</div>
            </section>
        </div>
    </div>
</x-layouts.app>
