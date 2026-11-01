<nav class="relative z-30 mb-4 flex shrink-0 flex-wrap items-center gap-4 rounded-2xl border border-white/15 light:border-neutral-300/70
            bg-linear-to-b from-white/15 light:from-white/90 to-white/3 light:to-white/40 px-4 py-3 text-white/80 light:text-neutral-700 backdrop-blur-2xl
            shadow-[inset_0_1px_0_rgba(255,255,255,0.2),0_12px_32px_rgba(0,0,0,0.3)] sm:gap-6 sm:px-6"
    aria-label="Main navigation">
    <div class="shrink-0">
        <h2>Hyvetree</h2>
    </div>

    <ul class="flex flex-wrap items-center gap-1 rounded-full border border-white/10 light:border-neutral-300/70 bg-neutral-950/30 light:bg-white/70 p-1
               shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">
        <li>
            <a href="{{ route('home') }}" @class([
                'block rounded-full px-4 py-2 text-sm font-medium transition duration-200 sm:px-5',
                'hover:bg-[#4CFC93]/10 hover:text-[#4CFC93] light:hover:text-emerald-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#4CFC93]',
                'bg-[#4CFC93]/10 text-[#4CFC93] light:text-emerald-700 ring-1 ring-inset ring-[#4CFC93]/25' => request()->routeIs('home'),
                'text-neutral-400 light:text-neutral-600' => !request()->routeIs('home'),
            ])
                aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}">{{ auth()->check() ? 'Dashboard' : 'Home' }}</a>
        </li>
        @auth
            <li>
                <a href="{{ route('projects.index') }}" @class([
                    'block rounded-full px-4 py-2 text-sm font-medium transition duration-200 sm:px-5',
                    'hover:bg-[#4CFC93]/10 hover:text-[#4CFC93] light:hover:text-emerald-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#4CFC93]',
                    'bg-[#4CFC93]/10 text-[#4CFC93] light:text-emerald-700 ring-1 ring-inset ring-[#4CFC93]/25' => request()->routeIs('projects.*'),
                    'text-neutral-400 light:text-neutral-600' => !request()->routeIs('projects.*'),
                ])
                    aria-current="{{ request()->routeIs('projects.*') ? 'page' : 'false' }}">Projects</a>
            </li>
            <li>
                <a href="{{ route('profile.show') }}" @class([
                    'block rounded-full px-4 py-2 text-sm font-medium transition duration-200 sm:px-5',
                    'hover:bg-[#4CFC93]/10 hover:text-[#4CFC93] light:hover:text-emerald-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#4CFC93]',
                    'bg-[#4CFC93]/10 text-[#4CFC93] light:text-emerald-700 ring-1 ring-inset ring-[#4CFC93]/25' => request()->routeIs('profile.*'),
                    'text-neutral-400 light:text-neutral-600' => !request()->routeIs('profile.*'),
                ])
                    aria-current="{{ request()->routeIs('profile.*') ? 'page' : 'false' }}">Profile</a>
            </li>
            <li><a href="{{ route('projects.manage') }}" class="block rounded-full px-4 py-2 text-sm font-medium text-neutral-400 transition hover:bg-[#4CFC93]/10 hover:text-[#4CFC93] light:text-neutral-600 light:hover:text-emerald-700">Manage</a></li>
            @if (auth()->user()->isAdmin())<li><a href="{{ route('admin.projects.index') }}" class="block rounded-full px-4 py-2 text-sm font-medium text-emerald-400 transition hover:bg-emerald-400/10 light:text-emerald-700">Admin</a></li>@endif
        @endauth
    </ul>

    <div class="ml-auto flex items-center gap-3">
        @auth
            {{-- Submit free-text project search with Enter. --}}
            <form role="search" method="GET" action="{{ route('projects.index') }}"
                class="group flex h-11 items-center gap-2 rounded-full border border-white/10 light:border-neutral-300/70 bg-neutral-950/30 light:bg-white/70 px-3
                          transition duration-200 hover:border-[#4CFC93]/30 light:hover:border-emerald-600/30 focus-within:border-[#4CFC93]/50 light:focus-within:border-emerald-600/50 focus-within:ring-2 focus-within:ring-[#4CFC93]/10">
                <span class="material-icons-outlined text-xl! text-neutral-500 light:text-neutral-600 transition group-focus-within:text-[#4CFC93] light:group-focus-within:text-emerald-700"
                    aria-hidden="true">search</span>
                <span class="sr-only">Search Hyvetree</span>
                <input type="search" name="q" aria-label="Search projects" maxlength="255" value="{{ request('q') }}" placeholder="Search Hyvetree…"
                    class="w-28 min-w-0 bg-transparent text-sm text-white light:text-neutral-900 outline-none placeholder:text-neutral-500 light:placeholder:text-neutral-600 sm:w-40 lg:w-52">
            </form>

            <div class="group/profile relative">
                <button type="button" aria-label="Account options"
                    class="inline-flex h-11 max-w-56 items-center gap-2 rounded-full border border-white/15 light:border-neutral-300/70 bg-linear-to-b from-white/15 light:from-white/90 to-white/5 light:to-white/40 pl-2 pr-3 text-neutral-300 light:text-neutral-600 shadow-[inset_0_1px_0_rgba(255,255,255,0.15)] transition hover:border-[#4CFC93]/60 light:hover:border-emerald-600/60 hover:bg-[#4CFC93]/10 hover:text-[#4CFC93] light:hover:text-emerald-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93] group-focus-within/profile:border-[#4CFC93]/40">
                    <span
                        class="material-icons-outlined shrink-0 text-[28px]! text-neutral-400 light:text-neutral-600 transition group-hover/profile:text-[#4CFC93] group-focus-within/profile:text-[#4CFC93]"
                        aria-hidden="true">account_circle</span>
                    <span
                        class="min-w-0 truncate text-sm font-medium">{{ \Illuminate\Support\Str::before(trim(auth()->user()->name), ' ') }}</span>
                    <span
                        class="material-icons-outlined text-lg! text-neutral-500 light:text-neutral-600 transition group-hover/profile:rotate-180 group-focus-within/profile:rotate-180"
                        aria-hidden="true">expand_more</span>
                </button>

                <div
                    class="invisible absolute right-0 top-full z-50 w-64 max-w-[calc(100vw-2rem)] pt-3 opacity-0 transition-[opacity,visibility] duration-150 group-hover/profile:visible group-hover/profile:opacity-100 group-focus-within/profile:visible group-focus-within/profile:opacity-100">
                    <div
                        class="overflow-hidden rounded-2xl border border-white/15 light:border-neutral-300/70 bg-neutral-900/95 light:bg-white p-2 shadow-[inset_0_1px_0_rgba(255,255,255,0.1),0_16px_48px_rgba(0,0,0,0.45)] backdrop-blur-2xl">
                        <div class="border-b border-white/10 light:border-neutral-300/70 px-3 pb-3 pt-2">
                            <p class="truncate text-sm font-semibold text-white light:text-neutral-900">{{ auth()->user()->name }}</p>
                            <p class="mt-1 truncate text-xs text-neutral-500 light:text-neutral-600">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="py-2">
                            @if (\Illuminate\Support\Facades\Route::has('profile.show'))
                                <a href="{{ route('profile.show') }}"
                                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm text-neutral-300 light:text-neutral-600 transition hover:bg-[#4CFC93]/10 hover:text-[#4CFC93] light:hover:text-emerald-700 focus-visible:outline-2 focus-visible:outline-inset focus-visible:outline-[#4CFC93]"><span
                                        class="material-icons-outlined text-xl!"
                                        aria-hidden="true">manage_accounts</span>Profile settings</a>
                            @else
                                <button type="button" disabled
                                    class="flex w-full cursor-not-allowed items-center gap-3 rounded-xl px-3 py-3 text-left text-sm text-neutral-500 light:text-neutral-600"><span
                                        class="material-icons-outlined text-xl!" aria-hidden="true">manage_accounts</span><span
                                        class="flex-1">Profile settings</span><span
                                        class="text-[10px] text-neutral-600 light:text-neutral-500">Soon</span></button>
                            @endif
                        </div>
                        <div class="border-t border-white/10 light:border-neutral-300/70 pt-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left text-sm text-neutral-300 light:text-neutral-600 transition hover:bg-[#4CFC93]/10 hover:text-[#4CFC93] light:hover:text-emerald-700 focus-visible:outline-2 focus-visible:outline-inset focus-visible:outline-[#4CFC93]"><span
                                        class="material-icons-outlined text-xl!" aria-hidden="true">logout</span>Log
                                    out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}"
                class="rounded-full px-4 py-2.5 text-sm font-medium text-neutral-300 light:text-neutral-600 transition hover:bg-white/5 light:hover:bg-white/80 hover:text-[#4CFC93] light:hover:text-emerald-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Log
                in</a>
            <a href="{{ route('register') }}"
                class="inline-flex items-center gap-2 rounded-full bg-[#4CFC93] px-5 py-2.5 text-sm font-semibold text-neutral-950 transition hover:bg-[#79fdae] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Create
                account<span class="material-icons-outlined text-lg!" aria-hidden="true">arrow_forward</span></a>
        @endauth
    </div>
</nav>