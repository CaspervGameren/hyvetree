<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Project extends Model
{
    public const STATUSES = [
        'planned' => 'Planned',
        'in_progress' => 'In progress',
        'on_hold' => 'On hold',
        'completed' => 'Completed',
    ];

    public const ICONS = ['folder', 'code', 'palette', 'school', 'lightbulb', 'rocket_launch', 'eco'];

    protected $fillable = [
        'title', 'summary', 'description', 'icon', 'status', 'is_public',
        'started_at', 'target_end_date',
    ];

    protected function casts(): array
    {
        return ['is_public' => 'boolean', 'started_at' => 'date', 'target_end_date' => 'date'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            // Keep URLs stable on edits, including when different users choose the same title.
            $base = substr(Str::slug($project->title), 0, 210) ?: 'project';
            $project->slug = $base.'-'.strtolower((string) Str::ulid());
        });
    }
}
