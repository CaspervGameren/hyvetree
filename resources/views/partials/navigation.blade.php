<nav class="flex shrink-0 items-center justify-between
            rounded-md border border-white/15
            bg-linear-to-b from-white/15 to-white/3
            px-6 py-2 text-white/80 backdrop-blur-2xl
            shadow-[inset_0_1px_0_rgba(255,255,255,0.2),0_12px_32px_rgba(0,0,0,0.3)] mb-4">
    <div><h2>Hyvetree</h2></div>
    <div>
        <ul class="flex gap-8">
            <li
                class="rounded-2xl border border-white/15 bg-linear-to-b from-white/15 to-white/3 px-6 py-2.5 text-white/80 backdrop-blur-xl shadow-[inset_0_1px_0_rgba(255,255,255,0.2),0_4px_12px_rgba(0,0,0,0.2)]">
                <a href="{{ route('home') }}">Dashboard</a>
            </li>
            <li
                class="rounded-2xl border border-white/15 bg-linear-to-b from-white/15 to-white/3 px-6 py-2.5 text-white/80 backdrop-blur-xl shadow-[inset_0_1px_0_rgba(255,255,255,0.2),0_4px_12px_rgba(0,0,0,0.2)]">
                <a href="{{ route('projects.index') }}">Projects</a>
            </li>
            {{-- <li
                class="rounded-2xl border border-white/15 bg-linear-to-b from-white/15 to-white/3 px-6 py-2.5 text-white/80 backdrop-blur-xl shadow-[inset_0_1px_0_rgba(255,255,255,0.2),0_4px_12px_rgba(0,0,0,0.2)]">
                Requests
            </li> --}}
        </ul>
    </div>
    <div class="bg-neutral-800 rounded-full px-3 py-2 hover:bg-neutral-600">
        <a href="#" aria-label="Profile page for user">
            <span class="material-icons-outlined text-[40px]!">person</span>
        </a>
    </div>
</nav>