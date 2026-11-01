<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $filters = $this->filters($request);
        $projects = $this->filtered(
            Project::query()->where(function (Builder $query) use ($request) {
                $query->where('is_public', true)->orWhere('user_id', $request->user()->id);
            }), $filters
        )->with('user')->withCount('likedBy')
            ->withExists(['likedBy as is_liked' => fn (Builder $query) => $query->where('users.id', $request->user()->id)])
            ->latest()->paginate(12)->withQueryString();

        return view('pages.projects.index', compact('projects', 'filters'));
    }

    public function manage(Request $request)
    {
        $projects = $request->user()->projects()->with('user')->withCount('likedBy')->latest()->paginate(10, ['*'], 'own_page');
        // A like does not grant access after a project becomes private.
        $likedProjects = $request->user()->likedProjects()->where('is_public', true)
            ->with('user')->withCount('likedBy')->latest('projects.created_at')->paginate(10, ['projects.*'], 'liked_page');

        return view('pages.projects.manage', compact('projects', 'likedProjects'));
    }

    public function create()
    {
        return view('pages.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateProject($request);
        $project = DB::transaction(function () use ($request, $validated) {
            $owner = User::query()->lockForUpdate()->findOrFail($request->user()->id);
            $this->checkPublication($owner, (bool) $validated['is_public'], $request->user());

            return $owner->projects()->create($validated);
        });

        return redirect()->route('projects.show', $project)->with('success', 'Project created.');
    }

    public function show(Request $request, Project $project)
    {
        Gate::authorize('view', $project);
        $project->load('user')->loadCount('likedBy');
        $isLiked = $project->likedBy()->where('users.id', $request->user()->id)->exists();

        return view('pages.projects.show', compact('project', 'isLiked'));
    }

    public function edit(Project $project)
    {
        Gate::authorize('update', $project);

        return view('pages.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        Gate::authorize('update', $project);
        $validated = $this->validateProject($request);
        DB::transaction(function () use ($project, $validated, $request) {
            $owner = User::query()->lockForUpdate()->findOrFail($project->user_id);
            if (! $project->is_public) {
                $this->checkPublication($owner, (bool) $validated['is_public'], $request->user());
            }
            $project->update($validated);
        });

        return redirect()->route('projects.show', $project)->with('success', 'Project updated.');
    }

    public function destroy(Request $request, Project $project)
    {
        Gate::authorize('delete', $project);
        $project->delete();

        return redirect()->route($request->user()->isAdmin() ? 'admin.projects.index' : 'projects.manage')->with('success', 'Project deleted.');
    }

    public function toggleVisibility(Request $request, Project $project)
    {
        Gate::authorize('changeVisibility', $project);
        DB::transaction(function () use ($project, $request) {
            $owner = User::query()->lockForUpdate()->findOrFail($project->user_id);
            $project->refresh();
            $this->checkPublication($owner, ! $project->is_public, $request->user());
            $project->update(['is_public' => ! $project->is_public]);
        });

        return back()->with('success', 'Project visibility updated.');
    }

    public function toggleLike(Request $request, Project $project)
    {
        Gate::authorize('like', $project);
        DB::transaction(function () use ($request, $project) {
            $user = User::query()->lockForUpdate()->findOrFail($request->user()->id);
            $user->likedProjects()->toggle($project->id);
        });

        return back()->with('success', 'Liked projects updated.');
    }

    public function filters(Request $request): array
    {
        return $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', Rule::in(array_keys(Project::STATUSES))],
        ]);
    }

    public function filtered(Builder $query, array $filters): Builder
    {
        if (filled($filters['q'] ?? null)) {
            $search = '%'.$filters['q'].'%';
            $query->where(fn (Builder $query) => $query->where('title', 'like', $search)->orWhere('summary', 'like', $search));
        }
        if (filled($filters['status'] ?? null)) {
            $query->where('status', $filters['status']);
        }

        return $query;
    }

    private function validateProject(Request $request): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string', 'max:500'],
            'description' => ['nullable', 'string', 'max:20000'],
            'icon' => ['nullable', Rule::in(Project::ICONS)],
            'status' => ['required', Rule::in(array_keys(Project::STATUSES))],
            'is_public' => ['required', 'boolean'],
            'started_at' => ['nullable', 'date_format:Y-m-d'],
            'target_end_date' => ['nullable', 'date_format:Y-m-d'],
        ];
        if ($request->filled('started_at')) {
            $rules['target_end_date'][] = 'after_or_equal:started_at';
        }

        return $request->validate($rules);
    }

    private function checkPublication(User $owner, bool $publishing, User $actor): void
    {
        if ($actor->isAdmin()) {
            return;
        }

        // Count the actual related records: no stored counter or frontend-only restriction.
        if ($publishing && $owner->projects()->count() < 3) {
            throw ValidationException::withMessages([
                'is_public' => 'Create at least 3 projects before publishing a project. You can save it privately first.',
            ]);
        }
    }
}
