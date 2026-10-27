<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'icon' => [
                'nullable',
                'string',
                Rule::in([
                    'folder',
                    'code',
                    'palette',
                    'school',
                    'lightbulb',
                    'rocket_launch',
                    'eco',
                ]),
            ],
            'status' => [
                'required',
                Rule::in(['planned', 'in_progress', 'on_hold', 'completed']),
            ],
            'is_public' => ['required', 'boolean'],
            'started_at' => ['nullable', 'date_format:Y-m-d'],
            'target_end_date' => ['nullable', 'date_format:Y-m-d'],
        ];

        if ($request->filled('started_at')) {
            $rules['target_end_date'] = 'after_or_equal:started_at';
        }

        $validated = $request->validate($rules);

        $project = $request->user()->projects()->create($validated);

        return redirect()->route('projects.show', ['id' => $project->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
