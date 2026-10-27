<x-layouts.app title="Create project">
    <div class="space-y-8">
        <div>
            <a href="{{ route('projects.index') }}" class="text-sm text-neutral-400 transition hover:text-emerald-300">&larr; All projects</a>
            <h1 class="mt-4 text-4xl font-bold">Create Project</h1>
            <p class="mt-3 max-w-xl text-sm leading-6 text-neutral-400">Give your project a name, a little direction, and a place to grow.</p>
        </div>
        <form action="{{ route('projects.store') }}" method="POST" class="@container space-y-6">
            @csrf
            <div class="grid items-start gap-6 @min-[140rem]:grid-cols-2">
            <section class="rounded-2xl border border-white/10 bg-linear-to-br from-white/6 to-white/2 p-5 sm:p-8" aria-labelledby="details-heading">
                <div class="mb-7 flex items-center gap-3">
                    <span class="material-icons-outlined rounded-xl bg-emerald-400/10 p-2 text-emerald-300" aria-hidden="true">edit_note</span>
                    <div><h2 id="details-heading" class="font-semibold">The essentials</h2><p class="mt-1 text-sm text-neutral-500">What are you working on?</p></div>
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2"><label for="title" class="text-sm font-medium">Project name <span class="text-emerald-400">*</span></label><input class="mt-2 w-full rounded-xl border border-white/15 bg-neutral-950/60 px-4 py-3 text-sm text-white placeholder:text-neutral-600 outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/15" id="title" name="title" type="text" maxlength="255" placeholder="e.g. My personal portfolio" required aria-describedby="slug-help"><p id="slug-help" class="mt-2 text-xs leading-5 text-neutral-500">A URL-friendly slug is generated automatically from the project name when you save.</p></div>
                    <div class="sm:col-span-2"><label for="summary" class="text-sm font-medium">Short summary <span class="text-emerald-400">*</span></label><textarea class="mt-2 w-full rounded-xl border border-white/15 bg-neutral-950/60 px-4 py-3 text-sm text-white placeholder:text-neutral-600 outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/15 resize-y" id="summary" name="summary" rows="2" maxlength="500" placeholder="The big idea, in a couple of sentences." required aria-describedby="summary-help"></textarea><p id="summary-help" class="mt-2 text-xs text-neutral-500">Keep it brief. Maximum 500 characters.</p></div>
                    <div class="sm:col-span-2"><label for="description" class="text-sm font-medium">Description <span class="font-normal text-neutral-500">(optional)</span></label><textarea class="mt-2 w-full rounded-xl border border-white/15 bg-neutral-950/60 px-4 py-3 text-sm text-white placeholder:text-neutral-600 outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/15 resize-y" id="description" name="description" rows="6" placeholder="Describe your goals, ideas, or what success looks like."></textarea></div>
                </div>
            </section>
            <section class="rounded-2xl border border-white/10 bg-linear-to-br from-white/6 to-white/2 p-5 sm:p-8" aria-labelledby="settings-heading">
                <h2 id="settings-heading" class="font-semibold">Make it yours</h2>
                <p class="mt-1 text-sm text-neutral-500">Set a starting point and choose who can see your project.</p>
                <div class="mt-7 grid gap-6 sm:grid-cols-2">
                    <fieldset class="sm:col-span-2">
                        <legend class="text-sm font-medium">Project icon</legend>
                        <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-7 @min-[140rem]:grid-cols-4">
                            <label class="cursor-pointer">
                                <input class="peer sr-only" type="radio" name="icon" value="folder" checked>
                                <span class="flex h-full flex-col items-center gap-3 rounded-xl border border-white/15 bg-neutral-950/40 px-3 py-4 text-neutral-400 transition hover:border-emerald-400/40 hover:text-white peer-checked:border-emerald-400 peer-checked:bg-emerald-400/10 peer-checked:text-emerald-300 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-emerald-400"><span class="material-icons-outlined text-3xl!" aria-hidden="true">folder</span><span class="text-xs font-medium">Folder</span></span>
                            </label>
                            <label class="cursor-pointer">
                                <input class="peer sr-only" type="radio" name="icon" value="code">
                                <span class="flex h-full flex-col items-center gap-3 rounded-xl border border-white/15 bg-neutral-950/40 px-3 py-4 text-neutral-400 transition hover:border-emerald-400/40 hover:text-white peer-checked:border-emerald-400 peer-checked:bg-emerald-400/10 peer-checked:text-emerald-300 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-emerald-400"><span class="material-icons-outlined text-3xl!" aria-hidden="true">code</span><span class="text-xs font-medium">Code</span></span>
                            </label>
                            <label class="cursor-pointer">
                                <input class="peer sr-only" type="radio" name="icon" value="palette">
                                <span class="flex h-full flex-col items-center gap-3 rounded-xl border border-white/15 bg-neutral-950/40 px-3 py-4 text-neutral-400 transition hover:border-emerald-400/40 hover:text-white peer-checked:border-emerald-400 peer-checked:bg-emerald-400/10 peer-checked:text-emerald-300 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-emerald-400"><span class="material-icons-outlined text-3xl!" aria-hidden="true">palette</span><span class="text-xs font-medium">Design</span></span>
                            </label>
                            <label class="cursor-pointer">
                                <input class="peer sr-only" type="radio" name="icon" value="school">
                                <span class="flex h-full flex-col items-center gap-3 rounded-xl border border-white/15 bg-neutral-950/40 px-3 py-4 text-neutral-400 transition hover:border-emerald-400/40 hover:text-white peer-checked:border-emerald-400 peer-checked:bg-emerald-400/10 peer-checked:text-emerald-300 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-emerald-400"><span class="material-icons-outlined text-3xl!" aria-hidden="true">school</span><span class="text-xs font-medium">Learning</span></span>
                            </label>
                            <label class="cursor-pointer">
                                <input class="peer sr-only" type="radio" name="icon" value="lightbulb">
                                <span class="flex h-full flex-col items-center gap-3 rounded-xl border border-white/15 bg-neutral-950/40 px-3 py-4 text-neutral-400 transition hover:border-emerald-400/40 hover:text-white peer-checked:border-emerald-400 peer-checked:bg-emerald-400/10 peer-checked:text-emerald-300 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-emerald-400"><span class="material-icons-outlined text-3xl!" aria-hidden="true">lightbulb</span><span class="text-xs font-medium">Idea</span></span>
                            </label>
                            <label class="cursor-pointer">
                                <input class="peer sr-only" type="radio" name="icon" value="rocket_launch">
                                <span class="flex h-full flex-col items-center gap-3 rounded-xl border border-white/15 bg-neutral-950/40 px-3 py-4 text-neutral-400 transition hover:border-emerald-400/40 hover:text-white peer-checked:border-emerald-400 peer-checked:bg-emerald-400/10 peer-checked:text-emerald-300 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-emerald-400"><span class="material-icons-outlined text-3xl!" aria-hidden="true">rocket_launch</span><span class="text-xs font-medium">Launch</span></span>
                            </label>
                            <label class="cursor-pointer">
                                <input class="peer sr-only" type="radio" name="icon" value="eco">
                                <span class="flex h-full flex-col items-center gap-3 rounded-xl border border-white/15 bg-neutral-950/40 px-3 py-4 text-neutral-400 transition hover:border-emerald-400/40 hover:text-white peer-checked:border-emerald-400 peer-checked:bg-emerald-400/10 peer-checked:text-emerald-300 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-emerald-400"><span class="material-icons-outlined text-3xl!" aria-hidden="true">eco</span><span class="text-xs font-medium">Growth</span></span>
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="sm:col-span-2">
                        <legend class="text-sm font-medium">Status <span class="text-emerald-400">*</span></legend>
                        <div class="mt-3 grid grid-cols-2 gap-3 lg:grid-cols-4 @min-[140rem]:grid-cols-2">
                            <label class="cursor-pointer">
                                <input class="peer sr-only" type="radio" name="status" value="planned" required checked>
                                <span class="flex h-full items-center gap-3 rounded-xl border border-white/15 bg-neutral-950/40 px-4 py-4 text-neutral-400 transition hover:border-emerald-400/40 hover:text-white peer-checked:border-emerald-400 peer-checked:bg-emerald-400/10 peer-checked:text-emerald-300 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-emerald-400"><span class="material-icons-outlined" aria-hidden="true">event_note</span><span><span class="block text-sm font-medium">Planned</span><span class="mt-1 block text-xs font-normal leading-5 text-neutral-400">An idea you haven’t started yet.</span></span></span>
                            </label>
                            <label class="cursor-pointer">
                                <input class="peer sr-only" type="radio" name="status" value="in_progress" required>
                                <span class="flex h-full items-center gap-3 rounded-xl border border-white/15 bg-neutral-950/40 px-4 py-4 text-neutral-400 transition hover:border-emerald-400/40 hover:text-white peer-checked:border-emerald-400 peer-checked:bg-emerald-400/10 peer-checked:text-emerald-300 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-emerald-400"><span class="material-icons-outlined" aria-hidden="true">pending</span><span><span class="block text-sm font-medium">In progress</span><span class="mt-1 block text-xs font-normal leading-5 text-neutral-400">Something you’re actively working on.</span></span></span>
                            </label>
                            <label class="cursor-pointer">
                                <input class="peer sr-only" type="radio" name="status" value="on_hold" required>
                                <span class="flex h-full items-center gap-3 rounded-xl border border-white/15 bg-neutral-950/40 px-4 py-4 text-neutral-400 transition hover:border-emerald-400/40 hover:text-white peer-checked:border-emerald-400 peer-checked:bg-emerald-400/10 peer-checked:text-emerald-300 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-emerald-400"><span class="material-icons-outlined" aria-hidden="true">pause_circle</span><span><span class="block text-sm font-medium">On hold</span><span class="mt-1 block text-xs font-normal leading-5 text-neutral-400">Paused until you’re ready to continue.</span></span></span>
                            </label>
                            <label class="cursor-pointer">
                                <input class="peer sr-only" type="radio" name="status" value="completed" required>
                                <span class="flex h-full items-center gap-3 rounded-xl border border-white/15 bg-neutral-950/40 px-4 py-4 text-neutral-400 transition hover:border-emerald-400/40 hover:text-white peer-checked:border-emerald-400 peer-checked:bg-emerald-400/10 peer-checked:text-emerald-300 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-emerald-400"><span class="material-icons-outlined" aria-hidden="true">check_circle</span><span><span class="block text-sm font-medium">Completed</span><span class="mt-1 block text-xs font-normal leading-5 text-neutral-400">Finished and ready to wrap up.</span></span></span>
                            </label>
                        </div>
                    </fieldset>
                    <div><label for="started_at" class="text-sm font-medium">Start date <span class="font-normal text-neutral-500">(optional)</span></label><input id="started_at" name="started_at" type="date" class="mt-2 w-full rounded-xl border border-white/15 bg-neutral-950/60 px-4 py-3 text-sm text-white placeholder:text-neutral-600 outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/15 scheme-dark"></div>
                    <div><label for="target_end_date" class="text-sm font-medium">Target end date <span class="font-normal text-neutral-500">(optional)</span></label><input id="target_end_date" name="target_end_date" type="date" class="mt-2 w-full rounded-xl border border-white/15 bg-neutral-950/60 px-4 py-3 text-sm text-white placeholder:text-neutral-600 outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/15 scheme-dark"></div>
                    <div class="sm:col-span-2">
                        <input type="hidden" name="is_public" value="0">
                        <label class="flex cursor-pointer items-center justify-between gap-6 rounded-xl border border-white/10 bg-neutral-950/40 p-4" for="is_public">
                            <span class="flex items-start gap-3">
                                <span class="material-icons-outlined mt-0.5 text-neutral-400" aria-hidden="true">public</span>
                                <span><span class="block text-sm font-medium">Public project</span><span id="visibility-help" class="mt-1 block text-xs leading-5 text-neutral-500">Let others discover your project. Leave off to keep it private.</span></span>
                            </span>
                            <span class="relative inline-flex shrink-0">
                                <input id="is_public" class="peer sr-only" type="checkbox" role="switch" name="is_public" value="1" aria-describedby="visibility-help">
                                <span class="h-7 w-12 rounded-full border border-white/15 bg-neutral-700 transition peer-checked:border-emerald-400 peer-checked:bg-emerald-400 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-emerald-400" aria-hidden="true"></span>
                                <span class="pointer-events-none absolute left-1 top-1 h-5 w-5 rounded-full bg-white shadow-sm transition-transform peer-checked:translate-x-5 peer-checked:bg-neutral-950" aria-hidden="true"></span>
                            </span>
                        </label>
                    </div>
                </div>
            </section>
            </div>
            <div class="flex flex-col-reverse gap-3 border-t border-white/10 pt-6 sm:flex-row sm:items-center sm:justify-between"><p class="text-xs text-neutral-500">Every great project starts somewhere.</p><div class="flex items-center justify-end gap-4"><a href="{{ route('projects.index') }}" class="rounded-xl px-4 py-3 text-sm text-neutral-400 transition hover:text-white">Cancel</a><button type="submit" class="rounded-xl bg-emerald-400 px-6 py-3 text-sm font-semibold text-neutral-950 transition hover:bg-emerald-300 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-emerald-400">Create project &rarr;</button></div></div>
        </form>
    </div>
</x-layouts.app>
