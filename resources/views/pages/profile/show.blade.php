<x-layouts.app title="Profile">
    <div class="space-y-6">
        <header class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-4xl font-bold tracking-tight">Your profile</h1>
                <p class="mt-3 text-sm leading-6 text-neutral-400 light:text-neutral-600">Your details, your account, your space in Hyvetree.
                </p>
            </div>
            @if (\Illuminate\Support\Facades\Route::has('profile.edit'))
                <a href="{{ route('profile.edit') }}"
                    class="inline-flex w-fit items-center gap-2 rounded-xl bg-[#4CFC93] px-5 py-3 text-sm font-semibold text-neutral-950 transition hover:bg-[#79fdae] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]"><span
                        class="material-icons-outlined text-lg!" aria-hidden="true">edit</span>Edit profile</a>
            @else
                <button type="button" disabled
                    class="inline-flex w-fit cursor-not-allowed items-center gap-2 rounded-xl border border-white/10 light:border-neutral-300/70 bg-white/5 light:bg-white/80 px-5 py-3 text-sm text-neutral-500 light:text-neutral-600"><span
                        class="material-icons-outlined text-lg!" aria-hidden="true">edit</span>Edit profile<span
                        class="text-xs">Soon</span></button>
            @endif
        </header>

        <div class="grid items-start gap-6 lg:grid-cols-[20rem_minmax(0,1fr)]">
            <section class="overflow-hidden rounded-2xl border border-white/10 light:border-neutral-300/70 bg-linear-to-br from-white/6 light:from-white/90 to-white/2 light:to-white/40"
                aria-labelledby="identity-heading">
                <div class="h-24 border-b border-white/10 light:border-neutral-300/70 bg-linear-to-br from-[#4CFC93]/15 via-[#4CFC93]/5 to-transparent"
                    aria-hidden="true"></div>
                <div class="px-6 pb-7">
                    <span
                        class="material-icons-outlined relative -mt-9 inline-flex rounded-2xl border border-white/15 light:border-neutral-300/70 bg-neutral-900 light:bg-white p-4 text-4xl! text-[#4CFC93] light:text-emerald-700 shadow-lg"
                        aria-hidden="true">person_outline</span>
                    <h2 id="identity-heading" class="mt-4 break-words text-xl font-semibold tracking-tight">
                        {{ $user->name }}</h2>
                    <p class="mt-2 break-all text-sm text-neutral-500 light:text-neutral-600">{{ $user->email }}</p>
                    <div class="mt-6 flex items-start gap-3 border-t border-white/10 light:border-neutral-300/70 pt-5"><span
                            class="material-icons-outlined text-xl! text-neutral-500 light:text-neutral-600" aria-hidden="true">eco</span>
                        <p class="text-xs leading-6 text-neutral-500 light:text-neutral-600">A home for your projects and the ideas you want to
                            grow.</p>
                    </div>
                </div>
            </section>

            <div class="min-w-0 space-y-6">
                <section class="rounded-2xl border border-white/10 light:border-neutral-300/70 bg-linear-to-br from-white/5 light:from-white/90 to-white/2 light:to-white/40 p-6 sm:p-8"
                    aria-labelledby="details-heading">
                    <div class="flex items-center gap-3"><span
                            class="material-icons-outlined rounded-xl bg-white/5 light:bg-white/80 p-2 text-neutral-400 light:text-neutral-600"
                            aria-hidden="true">badge</span>
                        <div>
                            <h2 id="details-heading" class="font-semibold">Personal details</h2>
                            <p class="mt-1 text-xs leading-5 text-neutral-500 light:text-neutral-600">The information associated with your
                                account.</p>
                        </div>
                    </div>
                    <dl class="mt-7 divide-y divide-white/10">
                        <div class="grid gap-2 py-5 sm:grid-cols-[10rem_1fr]">
                            <dt class="text-sm text-neutral-500 light:text-neutral-600">Full name</dt>
                            <dd class="break-words text-sm text-neutral-200 light:text-neutral-800">{{ $user->name }}</dd>
                        </div>
                        <div class="grid gap-2 py-5 sm:grid-cols-[10rem_1fr]">
                            <dt class="text-sm text-neutral-500 light:text-neutral-600">Email address</dt>
                            <dd class="break-all text-sm text-neutral-200 light:text-neutral-800">{{ $user->email }}</dd>
                        </div>
                        <div class="grid gap-2 py-5 sm:grid-cols-[10rem_1fr]">
                            <dt class="text-sm text-neutral-500 light:text-neutral-600">Member since</dt>
                            <dd class="text-sm text-neutral-200 light:text-neutral-800">{{ $user->created_at?->format('d-m-Y') ?? '—' }}</dd>
                        </div>
                    </dl>
                </section>

                <section class="rounded-2xl border border-white/10 light:border-neutral-300/70 bg-linear-to-br from-white/5 light:from-white/90 to-white/2 light:to-white/40 p-6 sm:p-8"
                    aria-labelledby="account-heading">
                    <div class="flex items-center gap-3"><span
                            class="material-icons-outlined rounded-xl bg-white/5 light:bg-white/80 p-2 text-neutral-400 light:text-neutral-600"
                            aria-hidden="true">shield</span>
                        <div>
                            <h2 id="account-heading" class="font-semibold">Account information</h2>
                            <p class="mt-1 text-xs leading-5 text-neutral-500 light:text-neutral-600">Your access and verification details.</p>
                        </div>
                    </div>
                    <dl class="mt-7 divide-y divide-white/10">
                        <div class="grid gap-2 py-5 sm:grid-cols-[10rem_1fr]">
                            <dt class="text-sm text-neutral-500 light:text-neutral-600">Account role</dt>
                            <dd class="flex flex-wrap gap-2 text-sm">@forelse ($user->roles as $role)<span
                            class="rounded-full border border-[#4CFC93]/20 light:border-emerald-600/20 bg-[#4CFC93]/10 px-3 py-1 text-xs font-medium text-[#4CFC93] light:text-emerald-700">{{ ucfirst($role->name) }}</span>@empty<span
                                    class="text-neutral-500 light:text-neutral-600">No role assigned</span>@endforelse</dd>
                        </div>
                        <div class="grid gap-2 py-5 sm:grid-cols-[10rem_1fr]">
                            <dt class="text-sm text-neutral-500 light:text-neutral-600">Email verification</dt>
                            <dd
                                class="flex items-center gap-2 text-sm {{ $user->email_verified_at ? 'text-[#4CFC93] light:text-emerald-700' : 'text-neutral-400 light:text-neutral-600' }}">
                                <span class="material-icons-outlined text-lg!"
                                    aria-hidden="true">{{ $user->email_verified_at ? 'verified' : 'mail_outline' }}</span>{{ $user->email_verified_at ? 'Verified' : 'Not verified' }}
                            </dd>
                        </div>
                    </dl>
                    <p
                        class="mt-4 flex items-start gap-2 rounded-xl border border-white/10 light:border-neutral-300/70 bg-neutral-950/30 light:bg-white/70 p-4 text-xs leading-6 text-neutral-500 light:text-neutral-600">
                        <span class="material-icons-outlined mt-0.5 text-base!"
                            aria-hidden="true">lock_outline</span>Your password is kept private and is never displayed
                        on your profile.</p>
                </section>
            </div>
        </div>
    </div>
</x-layouts.app>