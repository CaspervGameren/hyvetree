<x-layouts.app title="Projects">
    <div class="space-y-6">
        <header class="flex flex-wrap items-end justify-between gap-4"><div><h1 class="text-4xl font-bold">Project Overview</h1><p class="ui-muted mt-3">Discover public projects and find your own ideas.</p></div><div class="flex flex-wrap gap-3"><a class="ui-secondary" href="{{ route('projects.manage') }}">Manage projects</a><a class="ui-button" href="{{ route('projects.create') }}">New project</a></div></header>
        @include('pages.projects.partials.filters')
        <div class="grid gap-5 md:grid-cols-2 2xl:grid-cols-3">@forelse ($projects as $project)<x-project-card :project="$project" />@empty<div class="ui-panel p-8 md:col-span-2 2xl:col-span-3"><h2 class="text-xl font-semibold">No projects found.</h2><p class="ui-muted mt-3">Try another search or create a project of your own.</p></div>@endforelse</div>
        {{ $projects->links() }}
    </div>
</x-layouts.app>
