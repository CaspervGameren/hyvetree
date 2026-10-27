<x-layouts.app title="Home" :show-sidebar="false">
    <div class="space-y-6">
        <section class="relative overflow-hidden rounded-3xl border border-white/10 bg-linear-to-br from-[#4CFC93]/8 via-white/3 to-neutral-950 px-6 py-12 sm:px-10 sm:py-16 lg:px-14">
            <div class="pointer-events-none absolute -right-24 -top-24 h-96 w-96 rounded-full bg-[#4CFC93]/8 blur-3xl" aria-hidden="true"></div>
            <div class="relative grid items-center gap-12 lg:grid-cols-[1.1fr_0.9fr]">
                <div>
                    <h1 class="text-4xl font-semibold leading-tight tracking-tight sm:text-6xl">Your ideas.<br>Your projects.<br><span class="text-[#4CFC93]">Room to grow.</span></h1>
                    <p class="mt-6 max-w-xl text-base leading-8 text-neutral-400">Give the things you want to build a home. Bring your ideas together, set a direction, and make progress one project at a time.</p>
                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-3 rounded-xl bg-[#4CFC93] px-6 py-3.5 text-sm font-semibold text-neutral-950 transition hover:bg-[#79fdae] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Create your account<span class="material-icons-outlined text-lg!" aria-hidden="true">arrow_forward</span></a>
                        <a href="/login" class="rounded-xl border border-white/15 bg-white/3 px-6 py-3.5 text-sm font-medium text-neutral-300 transition hover:border-[#4CFC93]/40 hover:bg-[#4CFC93]/5 hover:text-[#4CFC93] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Log in</a>
                    </div>
                    <p class="mt-4 text-xs text-neutral-500">A fresh workspace starts with an account.</p>
                </div>
                <div class="rounded-2xl border border-white/15 bg-linear-to-br from-white/8 to-white/2 p-5 shadow-[inset_0_1px_0_rgba(255,255,255,0.12),0_24px_64px_rgba(0,0,0,0.25)] sm:p-7" aria-label="Example of a Hyvetree workspace">
                    <div class="flex items-center justify-between gap-3 border-b border-white/10 pb-5"><span class="text-sm font-semibold">A little inspiration</span><span class="rounded-full border border-white/10 px-2.5 py-1 text-[10px] text-neutral-500">Example workspace</span></div>
                    <div class="mt-5 space-y-3">
                        <div class="flex items-start gap-4 rounded-xl border border-[#4CFC93]/20 bg-[#4CFC93]/5 p-4"><span class="material-icons-outlined rounded-lg bg-[#4CFC93]/10 p-2 text-[#4CFC93]" aria-hidden="true">code</span><div><h2 class="text-sm font-medium">My personal portfolio</h2><p class="mt-1 text-xs leading-5 text-neutral-400">Build a home for the work I’m proud of.</p><span class="mt-3 inline-flex items-center gap-1.5 text-xs text-[#4CFC93]"><span class="h-1.5 w-1.5 rounded-full bg-[#4CFC93]"></span>In progress</span></div></div>
                        <div class="flex items-start gap-4 rounded-xl border border-white/10 bg-neutral-950/30 p-4"><span class="material-icons-outlined rounded-lg bg-white/5 p-2 text-neutral-400" aria-hidden="true">school</span><div><h2 class="text-sm font-medium">Learn something new</h2><p class="mt-1 text-xs leading-5 text-neutral-500">Turn curiosity into your next project.</p><span class="mt-3 block text-xs text-neutral-400">Planned</span></div></div>
                        <div class="flex items-center gap-3 rounded-xl border border-dashed border-white/15 px-4 py-4 text-xs text-neutral-500"><span class="material-icons-outlined text-lg!" aria-hidden="true">add</span>And whatever you dream up next.</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="grid gap-4 md:grid-cols-3" aria-label="Make space for your next project">
            <article class="rounded-2xl border border-white/10 bg-linear-to-br from-white/5 to-white/2 p-6"><span class="material-icons-outlined text-[#4CFC93]" aria-hidden="true">lightbulb</span><h2 class="mt-4 font-semibold">Start with an idea</h2><p class="mt-2 text-sm leading-6 text-neutral-400">A side project, a learning goal, or something completely new. Give it a name and a place to begin.</p></article>
            <article class="rounded-2xl border border-white/10 bg-linear-to-br from-white/5 to-white/2 p-6"><span class="material-icons-outlined text-[#4CFC93]" aria-hidden="true">route</span><h2 class="mt-4 font-semibold">Give it direction</h2><p class="mt-2 text-sm leading-6 text-neutral-400">Describe what you want to achieve, choose a status, and set dates that work for you.</p></article>
            <article class="rounded-2xl border border-white/10 bg-linear-to-br from-white/5 to-white/2 p-6"><span class="material-icons-outlined text-[#4CFC93]" aria-hidden="true">lock_outline</span><h2 class="mt-4 font-semibold">Make it your own</h2><p class="mt-2 text-sm leading-6 text-neutral-400">Keep a project private or choose to make it public. Every idea gets its own space.</p></article>
        </section>
        <footer class="flex flex-col gap-4 border-t border-white/10 px-1 py-6 text-sm sm:flex-row sm:items-center sm:justify-between"><p class="text-neutral-500">Ready to make room for your next idea?</p><a href="{{ route('register') }}" class="inline-flex w-fit items-center gap-2 rounded text-[#4CFC93] transition hover:text-[#79fdae] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Get started with Hyvetree<span aria-hidden="true">&rarr;</span></a></footer>
    </div>
</x-layouts.app>
