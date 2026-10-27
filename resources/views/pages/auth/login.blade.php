<x-layouts.guest title="Log in">
    <div class="mb-7">
        <span class="material-icons-outlined mb-5 inline-flex rounded-2xl border border-[#4CFC93]/20 bg-[#4CFC93]/10 p-3 text-2xl! text-[#4CFC93]" aria-hidden="true">login</span>
        <h1 class="text-3xl font-semibold tracking-tight">Welcome back.</h1>
        <p class="mt-3 text-sm leading-6 text-neutral-400">Your ideas are right where you left them. Log in to your workspace.</p>
    </div>
    {-- Connect this POST URL to your authentication controller. --}
    <form action="/login" method="POST" class="space-y-5">
        @csrf
        <div>
            <label for="email" class="text-sm font-medium text-white/90">Email address</label>
            <input id="email" name="email" type="email" autocomplete="email" placeholder="you@example.com" class="mt-2 w-full rounded-xl border border-white/15 bg-neutral-950/50 px-4 py-3 text-sm text-white outline-none transition placeholder:text-neutral-600 hover:border-white/25 focus:border-[#4CFC93]/60 focus:ring-2 focus:ring-[#4CFC93]/10" required>
            
            @error('email')
                <p class="mt-2 text-xs text-rose-300" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password" class="text-sm font-medium text-white/90">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" placeholder="Enter your password" class="mt-2 w-full rounded-xl border border-white/15 bg-neutral-950/50 px-4 py-3 text-sm text-white outline-none transition placeholder:text-neutral-600 hover:border-white/25 focus:border-[#4CFC93]/60 focus:ring-2 focus:ring-[#4CFC93]/10" required>
            
            @error('password')
                <p class="mt-2 text-xs text-rose-300" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-wrap items-center justify-between gap-3 text-xs">
            <label class="inline-flex cursor-pointer items-center gap-2 text-neutral-400"><input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-white/20 accent-[#4CFC93]">Remember me</label>
            <a href="/forgot-password" class="rounded text-[#4CFC93] transition hover:text-[#4CFC93]/75 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Forgot password?</a>
        </div>
        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#4CFC93] px-5 py-3 text-sm font-semibold text-neutral-950 transition hover:bg-[#79fdae] active:scale-[0.99] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Log in<span class="material-icons-outlined text-lg!" aria-hidden="true">arrow_forward</span></button>
    </form>
    <p class="mt-7 border-t border-white/10 pt-6 text-center text-sm text-neutral-500">New to Hyvetree? <a href="/register" class="rounded text-[#4CFC93] transition hover:text-[#4CFC93]/75 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#4CFC93]">Create an account</a></p>
</x-layouts.guest>
