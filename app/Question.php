<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answer;
use App\Quiz;
class Question extends Model
{
    protected $fillable =[
        'question', 'quiz_id'
    ];
    private $limit = 10, $order = 'DESC';

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function storeQuestion($data)
    {
        $data['quiz_id'] = $data['quiz'];
        return Question::create($data);
    }

    public function getQuestions()
    {
        return Question::orderBy('created_at', $this->order)->with('quiz')->paginate($this->limit);
    }

    public function getQuestionById($id)
    {
        return Question::find($id);
    }

    public function updateQuestion($data, $id)
    {
        $question = Question::find($id);
        $question->question = $data['question'];
        $question->quiz_id = $data['quiz'];
        $question->save();
        return $question;
    }

    public function deleteQuestion($id)
    {
        return Question::find($id)->delete();
    }
}
