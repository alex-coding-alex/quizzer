<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['required'],
            'user_id' => ['required', 'exists:users'], //
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
