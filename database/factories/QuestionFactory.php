<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'is_multi_choice' => $this->faker->boolean(),
            'question_a' => $this->faker->word(),
            'question_b' => $this->faker->word(),
            'question_c' => $this->faker->word(),
            'question_d' => $this->faker->word(),
            'multi_choice_answer' => $this->faker->word(),
            'free_question' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'quiz_id' => Quiz::factory(),
        ];
    }
}
