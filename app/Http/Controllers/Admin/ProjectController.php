<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjectController as Projects;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $filters = app(Projects::class)->filters($request);
        $projects = app(Projects::class)->filtered(Project::query(), $filters)
            ->with('user')->withCount('likedBy')->latest()->paginate(15)->withQueryString();

        return view('pages.admin.projects.index', compact('projects', 'filters'));
    }
}
