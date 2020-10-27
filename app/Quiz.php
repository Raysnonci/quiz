<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\User;

class Quiz extends Model
{
    protected $table	= 'quizzes';
    protected $primaryKey = 'quiz_id';

    use Blameable;

    public function getPrefixName()
    {
        return "quiz";
    }

    protected $fillable = [
        'quiz_name', 'quiz_description', 'quiz_minutes', 'quiz_created_by', 'quiz_updated_by'
    ];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'quiz_user', 'quiz_user_quiz_id', 'quiz_user_user_id');
    }

    public function storeQuiz($data){
        $data['quiz_name'] = $data['name'];
        $data['quiz_description'] = $data['description'];
        $data['quiz_minutes'] = $data['minutes'];
        return Quiz::create($data);
    }

    public function allQuiz()
    {
        return Quiz::all();
    }

    public function getQuizById($id){
        return Quiz::find($id);
    }

    public function updateQuiz($data, $id)
    {
        $data['quiz_name'] = $data['name'];
        $data['quiz_description'] = $data['description'];
        $data['quiz_minutes'] = $data['minutes'];
        return Quiz::find($id)->update($data);
    }

    public function deleteQuiz($id)
    {
        return Quiz::find($id)->delete();
    }

    public function assignExam($data)
    {
        $quizId = $data['quiz_id'];
        $quiz = Quiz::find($quizId);
        $userId = $data['user_id'];
        return $quiz->users()->syncWithoutDetaching($userId);
    }

    public function hasQuizAttempted()
    {
        $attemptQuiz = [];
        $authUser = auth()->user()->id;
        $user = Result::where('user_id', $authUser)->get();
        foreach($user as $u)
        {
            array_push($attemptQuiz, $u->quiz_id);
        }
        return $attemptQuiz;
    }
}
