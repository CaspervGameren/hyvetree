<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'summary',
        'description',
        'icon',
        'status',
        'is_public',
        'started_at',
        'target_end_date',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::creating(function ($request) {
            $request->slug = Str::slug($request->title);
        });
    }
}
