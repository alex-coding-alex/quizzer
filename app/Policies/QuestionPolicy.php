<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Question $question): bool
    {
        return $question->quiz->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Question $question): bool
    {
        return $question->quiz->user_id === $user->id;
    }

    public function delete(User $user, Question $question): bool
    {
        return $question->quiz->user_id === $user->id;
    }

    public function restore(User $user, Question $question): bool
    {
        return false;
    }

    public function forceDelete(User $user, Question $question): bool
    {
        return false;
    }
}
