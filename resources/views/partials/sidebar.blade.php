<aside class="relative z-20 flex w-20 shrink-0 flex-col items-center gap-6 self-start text-white/80" aria-label="Workspace tools">
    {{-- Styling options --}}
    <div class="grid w-full justify-items-center gap-3 rounded-2xl border border-white/15
                bg-linear-to-b from-white/12 to-white/3 px-3 py-4 backdrop-blur-2xl
                shadow-[inset_0_1px_0_rgba(255,255,255,0.18),0_8px_24px_rgba(0,0,0,0.25)]"
         role="group" aria-label="Appearance and language">
        <x-icon-button icon="palette" label="Change theme" />
        <x-icon-button icon="translate" label="Change language" />
    </div>

    {{-- Quick actions --}}
    <div class="grid w-full justify-items-center gap-3 rounded-2xl border border-white/15
                bg-linear-to-b from-white/12 to-white/3 px-3 py-4 backdrop-blur-2xl
                shadow-[inset_0_1px_0_rgba(255,255,255,0.18),0_8px_24px_rgba(0,0,0,0.25)]"
         role="group" aria-label="Quick actions">
        <x-icon-button icon="create_new_folder" label="Create project" :href="route('projects.create')" :aria-current="request()->routeIs('projects.create') ? 'page' : null" />
        <x-icon-button icon="chat" label="Open chat" />
    </div>

    {{-- UserProjects: add a separate glass group here when project shortcuts are available. --}}
</aside>
