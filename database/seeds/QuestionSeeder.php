<?php

use App\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question = Question::create([
            'question_name' => '1+1',
            'question_quiz_id' => 1
        ]);
    }
}
