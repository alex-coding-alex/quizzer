<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Quiz $quiz): bool {}

    public function create(User $user): bool {}

    public function update(User $user, Quiz $quiz): bool {}

    public function delete(User $user, Quiz $quiz): bool {}

    public function restore(User $user, Quiz $quiz): bool {}

    public function forceDelete(User $user, Quiz $quiz): bool {}
}
