<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answer;
use App\Quiz;
class Question extends Model
{
    use Blameable;
    
    protected $table	= 'questions';
    protected $primaryKey = 'question_id';

    protected $fillable =[
        'question_name', 'question_quiz_id', 'question_created_by', 'question_updated_by'
    ];
    private $limit = 10, $order = 'DESC';

    public function getPrefixName()
    {
        return "question";
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'answer_question_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'question_quiz_id', 'quiz_id');
    }

    public function storeQuestion($data)
    {
        $data['question_quiz_id'] = $data['quiz'];
        $data['question_name'] = $data['question']; 
        $question = Question::create($data);
        return $question;
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
        $question->question_name = $data['question'];
        $question->question_quiz_id = $data['quiz'];
        $question->save();
        return $question;
    }

    public function deleteQuestion($id)
    {
        return Question::find($id)->delete();
    }
}
