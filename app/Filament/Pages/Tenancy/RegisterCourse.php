<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Course;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RegisterCourse extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Course';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('description'),
            ]);
    }

    protected function handleRegistration(array $data): Model
    {
        $course = new Course($data);
        $course->save();

        $course->users()->attach(Auth::user());

        return $course;
    }
}
