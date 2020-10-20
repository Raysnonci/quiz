<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
class Answer extends Model
{
    protected $fillable =[
        'question_id', 'answer', 'is_correct'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function storeAnswer($data, $question)
    {
        foreach($data['options'] as $key=>$option) 
        {
            $is_correct = false;
            if($key == $data['correct_answer'])
            {
                $is_correct = true;
            }
            $answer = Answer::create([
                'question_id' => $question->id,
                'answer' => $option,
                'is_correct' => $is_correct
            ]);
        }
    }

    public function updateAnswer($data, $question)
    {
        $getQuestion = Question::with('answers')->whereId($question->id)->first();
        $options = $data['options'];
        
        foreach($getQuestion->answers as $key=>$answer)
        {
            $option = $options[$key];
            $is_correct = false;
            if($key == $data['correct_answer'])
            {
                $is_correct = true;
            }
            Answer::find($answer->id)->update([
                'question_id' => $question->id,
                'answer' => $option,
                'is_correct' => $is_correct
            ]);
        }
    }

    public function deleteAnswer($questionId)
    {
        return Answer::where('question_id', $questionId)->delete();
    }
}
