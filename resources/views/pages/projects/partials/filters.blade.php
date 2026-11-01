<form method="GET" class="ui-panel flex flex-wrap items-end gap-4 p-5" aria-label="Filter projects">
    <div class="min-w-48 flex-1"><label for="q" class="ui-label">Search projects</label><input id="q" name="q" type="search" maxlength="255" value="{{ $filters['q'] ?? '' }}" placeholder="Search title or summary…" class="ui-input"></div>
    <div class="min-w-44"><label for="status" class="ui-label">Status</label><select id="status" name="status" class="ui-input"><option value="">All statuses</option>@foreach (\App\Models\Project::STATUSES as $value => $label)<option value="{{ $value }}" @selected(($filters['status'] ?? '') === $value)>{{ $label }}</option>@endforeach</select></div>
    <button class="ui-button" type="submit">Search &amp; filter</button><a class="ui-secondary" href="{{ url()->current() }}">Reset</a>
</form>
