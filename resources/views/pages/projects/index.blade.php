<x-layouts.app title="Projects">
    <div class="space-y-8">
        <header class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div><h1 class="text-4xl font-bold">Project Overview</h1><p class="mt-3 text-sm text-neutral-400">A little structure for your biggest ideas.</p></div>
            <a href="{{ route('projects.create') }}" class="inline-flex w-fit items-center gap-2 rounded-xl bg-emerald-400 px-5 py-3 text-sm font-semibold text-neutral-950 transition hover:bg-emerald-300"><span class="material-icons-outlined text-lg!" aria-hidden="true">add</span>New project</a>
        </header>
        {{-- Replace this empty state with project cards once the controller provides projects. --}}
        <section class="flex min-h-96 flex-col items-start justify-center rounded-2xl border border-dashed border-white/15 bg-linear-to-br from-white/5 to-transparent px-6 py-16 text-left">
            <div class="relative mb-7"><span class="material-icons-outlined rounded-2xl border border-emerald-300/15 bg-emerald-400/10 p-5 text-4xl! text-emerald-300" aria-hidden="true">create_new_folder</span><span class="absolute -right-2 -top-2 h-4 w-4 rounded-full border-4 border-neutral-950 bg-emerald-400"></span></div>
            <h2 class="text-xl font-semibold tracking-tight">Your next idea belongs here.</h2>
            <p class="mt-3 max-w-sm text-sm leading-6 text-neutral-400">Bring your plans, side projects, and things you want to learn together. Start with your first project.</p>
            <a href="{{ route('projects.create') }}" class="mt-7 rounded-xl border border-white/15 bg-white/5 px-5 py-3 text-sm font-medium transition hover:border-emerald-300/40 hover:bg-emerald-400/10 hover:text-emerald-300">Create your first project &rarr;</a>
        </section>
        <p class="flex items-center gap-2 text-xs text-neutral-500"><span class="material-icons-outlined text-base!" aria-hidden="true">eco</span>Small steps. Meaningful progress.</p>
    </div>
</x-layouts.app>
