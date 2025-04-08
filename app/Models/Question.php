<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'is_multi_choice',
        'question_a',
        'question_b',
        'question_c',
        'question_d',
        'multi_choice_answer',
        'free_question',
        'quiz_id',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    protected function casts(): array
    {
        return [
            'is_multi_choice' => 'boolean',
        ];
    }
}
