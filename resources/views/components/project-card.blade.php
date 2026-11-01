@props(['project'])
<article class="ui-panel flex h-full flex-col p-6 transition hover:border-emerald-400/40">
    <div class="flex items-start justify-between gap-4"><span class="material-icons-outlined rounded-xl bg-emerald-400/10 p-3 text-emerald-400 light:text-emerald-700" aria-hidden="true">{{ $project->icon ?: 'folder' }}</span><span class="ui-badge">{{ \App\Models\Project::STATUSES[$project->status] ?? $project->status }}</span></div>
    <h2 class="mt-5 break-words text-xl font-semibold"><a class="hover:text-emerald-400 light:hover:text-emerald-700" href="{{ route('projects.show', $project) }}">{{ $project->title }}</a></h2>
    <p class="ui-muted mt-3 flex-1 break-words text-sm leading-6">{{ $project->summary }}</p>
    <p class="ui-muted mt-5 text-xs">By {{ $project->user->name }} · {{ $project->is_public ? 'Public' : 'Private' }}</p>
    <div class="mt-5 flex flex-wrap items-center gap-3 border-t border-white/10 pt-4 light:border-neutral-200">
        <a class="ui-secondary" href="{{ route('projects.show', $project) }}">View</a>
        @can('update', $project)<a class="ui-secondary" href="{{ route('projects.edit', $project) }}">Edit</a>@endcan
        @can('like', $project)
            <form method="POST" action="{{ route('projects.like', $project) }}" class="ml-auto">@csrf<button type="submit" class="ui-secondary" aria-pressed="{{ $project->is_liked ? 'true' : 'false' }}"><span class="material-icons-outlined text-lg!" aria-hidden="true">{{ $project->is_liked ? 'favorite' : 'favorite_border' }}</span><span>{{ $project->is_liked ? 'Unlike' : 'Like' }} ({{ $project->liked_by_count }})</span></button></form>
        @else<span class="ui-muted ml-auto text-xs">{{ $project->liked_by_count }} likes</span>@endcan
    </div>
</article>
