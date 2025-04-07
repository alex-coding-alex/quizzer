<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Tags\HasTags;

class Quiz extends Model
{
    use HasFactory, HasRoles, HasTags, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'role_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
