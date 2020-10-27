<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answer;
use App\Question;
class Result extends Model
{
    protected $table	= 'results';
    protected $primaryKey = 'result_id';

    protected $fillable = [
        'result_user_id', 'result_question_id' , 'result_quiz_id' , 'result_answer_id', 'result_created_by', 'result_updated_by'
    ];

    public function getPrefixName()
    {
        return "result";
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
