<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => rtrim($this->faker->sentence(rand(1,5)),"."),
            'body' =>$this->faker->paragraph(rand(1,5),true),
            'views' =>rand(0,5),
            // 'answers_count' =>rand(1,5),
            // 'votes_count' => rand(-3,10)
        ];
    }
}
