<x-layouts.guest title="Create an account">
    <div class="mb-7">
        <span class="material-icons-outlined mb-5 inline-flex rounded-2xl border border-[#4CFC93]/20 light:border-emerald-600/20 bg-[#4CFC93]/10 p-3 text-2xl! text-[#4CFC93] light:text-emerald-700" aria-hidden="true">person_add</span>
        <h1 class="text-3xl font-semibold tracking-tight">Room for your ideas.</h1>
        <p class="mt-3 text-sm leading-6 text-neutral-400 light:text-neutral-600">Create your account and give your next project a place to grow.</p>
    </div>
    <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label for="name" class="text-sm font-medium text-white/90 light:text-neutral-700">Name</label>
            <input id="name" name="name" value="{{ old('name') }}" type="text" autocomplete="name" placeholder="Your name" class="mt-2 w-full rounded-xl border border-white/15 light:border-neutral-300/70 bg-neutral-950/50 light:bg-white/70 px-4 py-3 text-sm text-white light:text-neutral-900 outline-none transition placeholder:text-neutral-600 light:placeholder:text-neutral-500 hover:border-white/25 light:hover:border-neutral-300/70 focus:border-[#4CFC93]/60 light:focus:border-emerald-600/60 focus:ring-2 focus:ring-[#4CFC93]/10" required>
            
            @error('name')
                <p class="mt-2 text-xs text-rose-300" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email" class="text-sm font-medium text-white/90 light:text-neutral-700">Email address</label>
            <input id="email" name="email" value="{{ old('email') }}" type="email" autocomplete="email" placeholder="you@example.com" class="mt-2 w-full rounded-xl border border-white/15 light:border-neutral-300/70 bg-neutral-950/50 light:bg-white/70 px-4 py-3 text-sm text-white light:text-neutral-900 outline-none transition placeholder:text-neutral-600 light:placeholder:text-neutral-500 hover:border-white/25 light:hover:border-neutral-300/70 focus:border-[#4CFC93]/60 light:focus:border-emerald-600/60 focus:ring-2 focus:ring-[#4CFC93]/10" required>
            
            @error('email')
                <p class="mt-2 text-xs text-rose-300" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password" class="text-sm font-medium text-white/90 light:text-neutral-700">Password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" placeholder="Create a password" class="mt-2 w-full rounded-xl border border-white/15 light:border-neutral-300/70 bg-neutral-950/50 light:bg-white/70 px-4 py-3 text-sm text-white light:text-neutral-900 outline-none transition placeholder:text-neutral-600 light:placeholder:text-neutral-500 hover:border-white/25 light:hover:border-neutral-300/70 focus:border-[#4CFC93]/60 light:focus:border-emerald-600/60 focus:ring-2 focus:ring-[#4CFC93]/10" required aria-describedby="password-help">
            <p id="password-help" class="mt-2 text-xs leading-5 text-neutral-500 light:text-neutral-600">Choose a strong password you don’t use elsewhere.</p>
            @error('password')
                <p class="mt-2 text-xs text-rose-300" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password_confirmation" class="text-sm font-medium text-white/90 light:text-neutral-700">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Repeat your password" class="mt-2 w-full rounded-xl border border-white/15 light:border-neutral-300/70 bg-neutral-950/50 light:bg-white/70 px-4 py-3 text-sm text-white light:text-neutral-900 outline-none transition placeholder:text-neutral-600 light:placeholder:text-neutral-500 hover:border-white/25 light:hover:border-neutral-300/70 focus:border-[#4CFC93]/60 light:focus:border-emerald-600/60 focus:ring-2 focus:ring-[#4CFC93]/10" required>
            
            @error('password_confirmation')
                <p class="mt-2 text-xs text-rose-300" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#4CFC93] px-5 py-3 text-sm font-semibold text-neutral-950 transition hover:bg-[#79fdae] active:scale-[0.99] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Create account<span class="material-icons-outlined text-lg!" aria-hidden="true">arrow_forward</span></button>
    </form>
    <p class="mt-7 border-t border-white/10 light:border-neutral-300/70 pt-6 text-center text-sm text-neutral-500 light:text-neutral-600">Already have an account? <a href="/login" class="rounded text-[#4CFC93] light:text-emerald-700 transition hover:text-[#4CFC93]/75 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Log in</a></p>
</x-layouts.guest>
