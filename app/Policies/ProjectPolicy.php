<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function view(User $user, Project $project): bool
    {
        return $project->is_public || $project->user_id === $user->id || $user->isAdmin();
    }

    public function update(User $user, Project $project): bool
    {
        return $project->user_id === $user->id;
    }

    public function delete(User $user, Project $project): bool
    {
        return $project->user_id === $user->id || $user->isAdmin();
    }

    public function changeVisibility(User $user, Project $project): bool
    {
        return $project->user_id === $user->id || $user->isAdmin();
    }

    public function like(User $user, Project $project): bool
    {
        return $project->is_public && $project->user_id !== $user->id;
    }
}
