<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Quiz $quiz): bool
    {
        return $quiz->course->id === Filament::getTenant()->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Quiz $quiz): bool
    {
        return $quiz->course->id === Filament::getTenant()->id;
    }

    public function delete(User $user, Quiz $quiz): bool
    {
        return $quiz->course->id === Filament::getTenant()->id;
    }

    public function restore(User $user, Quiz $quiz): bool
    {
        return false;
    }

    public function forceDelete(User $user, Quiz $quiz): bool
    {
        return false;
    }
}
