<nav class="relative z-30 mb-4 flex shrink-0 flex-wrap items-center gap-4 rounded-2xl border border-white/15
            bg-linear-to-b from-white/15 to-white/3 px-4 py-3 text-white/80 backdrop-blur-2xl
            shadow-[inset_0_1px_0_rgba(255,255,255,0.2),0_12px_32px_rgba(0,0,0,0.3)] sm:gap-6 sm:px-6"
     aria-label="Main navigation">
    <div class="shrink-0"><h2>Hyvetree</h2></div>

    <ul class="flex shrink-0 items-center gap-1 rounded-full border border-white/10 bg-neutral-950/30 p-1
               shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">
        <li>
            <a href="{{ route('home') }}"
               @class([
                   'block rounded-full px-4 py-2 text-sm font-medium transition duration-200 sm:px-5',
                   'hover:bg-[#4CFC93]/10 hover:text-[#4CFC93] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#4CFC93]',
                   'bg-[#4CFC93]/10 text-[#4CFC93] ring-1 ring-inset ring-[#4CFC93]/25' => request()->routeIs('home'),
                   'text-neutral-400' => ! request()->routeIs('home'),
               ])
               aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}">Home</a>
        </li>
        <li>
            <a href="{{ route('projects.index') }}"
               @class([
                   'block rounded-full px-4 py-2 text-sm font-medium transition duration-200 sm:px-5',
                   'hover:bg-[#4CFC93]/10 hover:text-[#4CFC93] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#4CFC93]',
                   'bg-[#4CFC93]/10 text-[#4CFC93] ring-1 ring-inset ring-[#4CFC93]/25' => request()->routeIs('projects.*'),
                   'text-neutral-400' => ! request()->routeIs('projects.*'),
               ])
               aria-current="{{ request()->routeIs('projects.*') ? 'page' : 'false' }}">Projects</a>
        </li>
    </ul>

    <div class="ml-auto flex items-center gap-3">
        @auth
        {{-- Search presentation only; connect to search when its backend is ready. --}}
        <label class="group flex h-11 items-center gap-2 rounded-full border border-white/10 bg-neutral-950/30 px-3
                      transition duration-200 hover:border-[#4CFC93]/30 focus-within:border-[#4CFC93]/50 focus-within:ring-2 focus-within:ring-[#4CFC93]/10">
            <span class="material-icons-outlined text-xl! text-neutral-500 transition group-focus-within:text-[#4CFC93]" aria-hidden="true">search</span>
            <span class="sr-only">Search Hyvetree</span>
            <input type="search" name="search" placeholder="Search Hyvetree…"
                   class="w-28 min-w-0 bg-transparent text-sm text-white outline-none placeholder:text-neutral-500 sm:w-40 lg:w-52">
        </label>

        {{-- Connect the profile button when the account page is available. --}}
        <span class="group relative inline-flex">
            <button type="button" aria-label="Profile"
                    class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-white/15
                           bg-linear-to-b from-white/15 to-white/5 text-neutral-300
                           shadow-[inset_0_1px_0_rgba(255,255,255,0.15)] transition duration-200
                           hover:border-[#4CFC93]/60 hover:bg-[#4CFC93]/10 hover:text-[#4CFC93]
                           active:scale-95 active:bg-[#4CFC93]/20
                           focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">
                <span class="material-icons-outlined text-2xl!" aria-hidden="true">person_outline</span>
            </button>
            <span aria-hidden="true" class="pointer-events-none invisible absolute right-0 top-full z-50 mt-3 rounded-lg border border-white/15 bg-neutral-900 px-3 py-2 text-xs text-white/90 opacity-0 shadow-xl transition-[opacity,visibility] duration-150 group-hover:visible group-hover:opacity-100 group-hover:delay-1000 group-focus-within:visible group-focus-within:opacity-100 group-focus-within:delay-0">Profile</span>
        </span>
        @else
            <a href="/login" class="rounded-full px-4 py-2.5 text-sm font-medium text-neutral-300 transition hover:bg-white/5 hover:text-[#4CFC93] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Log in</a>
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-[#4CFC93] px-5 py-2.5 text-sm font-semibold text-neutral-950 transition hover:bg-[#79fdae] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Create account<span class="material-icons-outlined text-lg!" aria-hidden="true">arrow_forward</span></a>
        @endauth
    </div>
</nav>
