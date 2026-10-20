<aside class="grid w-20 shrink-0 grid-rows-[auto_auto_1fr] gap-6
              rounded-md border border-white/15
              bg-linear-to-b from-white/15 to-white/3
              p-3 text-white/80 backdrop-blur-2xl
              shadow-[inset_0_1px_0_rgba(255,255,255,0.2),0_12px_32px_rgba(0,0,0,0.3)]
              ">

    {{-- Styling options --}}
    <div class="grid min-h-27 content-start justify-items-center gap-3">
        <x-icon-button icon="palette" label="Change theme" />
        <x-icon-button icon="translate" label="Change language" />
    </div>

    {{-- Quick actions --}}
    <div class="grid min-h-27 content-start justify-items-center gap-3
                border-t border-white/10 pt-4">
        <x-icon-button icon="note_add" label="Create note" />
        <x-icon-button icon="chat" label="Open chat" />
    </div>

    {{-- UserProjects --}}
    <div class="grid content-start justify-items-center gap-3
                border-t border-white/10 pt-4">

    </div>
</aside>