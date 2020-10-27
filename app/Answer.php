<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
class Answer extends Model
{
    use Blameable;
    
    protected $table	= 'answers';
    protected $primaryKey = 'answer_id';

    protected $fillable =[
        'answer_question_id', 'answer_name', 'answer_is_correct', 'answer_created_by', 'answer_updated_by'
    ];

    public function getPrefixName()
    {
        return "answer";
    }

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
                'answer_question_id' => $question->question_id,
                'answer_name' => $option,
                'answer_is_correct' => $is_correct
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
                'answer_question_id' => $question->id,
                'answer_name' => $option,
                'answer_is_correct' => $is_correct
            ]);
        }
    }

    public function deleteAnswer($questionId)
    {
        return Answer::where('answer_question_id', $questionId)->delete();
    }
}
