<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'is_multi_choice' => ['boolean'],
            'question_a' => ['nullable'],
            'question_b' => ['nullable'],
            'question_c' => ['nullable'],
            'question_d' => ['nullable'],
            'multi_choice_answer' => ['nullable'],
            'free_question' => ['nullable'],
            'quiz_id' => ['required', 'exists:quizzes'], //
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
