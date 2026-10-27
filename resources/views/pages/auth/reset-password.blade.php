<x-layouts.guest title="Reset password">
    <div class="mb-7">
        <span class="material-icons-outlined mb-5 inline-flex rounded-2xl border border-[#4CFC93]/20 bg-[#4CFC93]/10 p-3 text-2xl! text-[#4CFC93]" aria-hidden="true">key</span>
        <h1 class="text-3xl font-semibold tracking-tight">A fresh start.</h1>
        <p class="mt-3 text-sm leading-6 text-neutral-400">Choose a new password for your Hyvetree account.</p>
    </div>
    {-- Connect this POST URL to your authentication controller. --}
    <form action="/reset-password" method="POST" class="space-y-5">
        @csrf
        {{-- Supply the reset token and email from your reset-link flow. --}}
        <input type="hidden" name="token" value="{{ $token ?? '' }}">
        <div>
            <label for="email" class="text-sm font-medium text-white/90">Email address</label>
            <input id="email" name="email" type="email" autocomplete="email" placeholder="you@example.com" class="mt-2 w-full rounded-xl border border-white/15 bg-neutral-950/50 px-4 py-3 text-sm text-white outline-none transition placeholder:text-neutral-600 hover:border-white/25 focus:border-[#4CFC93]/60 focus:ring-2 focus:ring-[#4CFC93]/10" required>
            
            @error('email')
                <p class="mt-2 text-xs text-rose-300" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password" class="text-sm font-medium text-white/90">New password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" placeholder="Create a new password" class="mt-2 w-full rounded-xl border border-white/15 bg-neutral-950/50 px-4 py-3 text-sm text-white outline-none transition placeholder:text-neutral-600 hover:border-white/25 focus:border-[#4CFC93]/60 focus:ring-2 focus:ring-[#4CFC93]/10" required>
            
            @error('password')
                <p class="mt-2 text-xs text-rose-300" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password_confirmation" class="text-sm font-medium text-white/90">Confirm new password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Repeat your new password" class="mt-2 w-full rounded-xl border border-white/15 bg-neutral-950/50 px-4 py-3 text-sm text-white outline-none transition placeholder:text-neutral-600 hover:border-white/25 focus:border-[#4CFC93]/60 focus:ring-2 focus:ring-[#4CFC93]/10" required>
            
            @error('password_confirmation')
                <p class="mt-2 text-xs text-rose-300" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#4CFC93] px-5 py-3 text-sm font-semibold text-neutral-950 transition hover:bg-[#79fdae] active:scale-[0.99] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Reset password<span class="material-icons-outlined text-lg!" aria-hidden="true">arrow_forward</span></button>
    </form>
    <p class="mt-7 text-center text-sm"><a href="/login" class="rounded text-[#4CFC93] transition hover:text-[#4CFC93]/75 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">&larr; Back to log in</a></p>
</x-layouts.guest>
