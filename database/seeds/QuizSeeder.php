<?php

use App\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quiz = Quiz::create([
            'quiz_name'=> 'Laravel Quiz',
            'quiz_description' => 'Quiz tentang laravel',
            'quiz_minutes' => 30
        ]);
    }
}
