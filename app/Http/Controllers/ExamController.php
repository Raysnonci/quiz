<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Quiz;
use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function create()
    {
        return view('backend.exam.assign');
    }

    public function assignExam(Request $request)
    {
        $quiz = (new Quiz())->assignExam($request->all());
        return redirect()-> back()->with('message', 'Exam assigned to user successfully');
    }

    public function userExam(Request $request)
    {
        $quizzes = Quiz::get();
        return view('backend.exam.index', compact('quizzes'));
    }

    public function removeExam(Request $request)
    {
        $userId = $request->get('user_id');
        $quizId = $request->get('quiz_id');
        $quiz = Quiz::find($quizId);
        $result = Result::where('quiz_id', $quizId)->where('user_id', $userId)->exists();
        if($result)
        {
            return redirect()->back()->with('message_r', 'This quiz already played by user, So it cannot be removed!');
        }else
        {
            $quiz->users()->detach($userId);
            return redirect()->back()->with('message_r', 'Exam removed successfully');
        }
    }

    public function getQuizQuestion(Request $request, $quizId)
    {
        $authUser = auth()->user()->id;

        //Check if user has been assigned
        $userId = DB::table('quiz_user')->whereUserId($authUser)->pluck('quiz_id')->toArray();
        if(!in_array($quizId, $userId)){
            return redirect()->to('/home')->with('error', 'You are not assigned this exam');
        }

        $quiz = Quiz::find($quizId);
        $time = Quiz::where('id', $quizId)->value('minutes');
        $quizQuestions = Question::where('quiz_id',$quizId)->with('answers')->get();
        $authUserHasPlayedQuiz = Result::where(['user_id'=>$authUser, 'quiz_id'=>$quizId])->get();

        //has user played particular quiz
        $wasCompleted = Result::whereUserId($authUser)->whereIn('quiz_id', (new Quiz)->hasQuizAttempted())->pluck('quiz_id')->toArray();
        if(in_array($quizId, $wasCompleted)){
            return redirect()->to('/home')->with('error', 'You already participate in this exam');
        }
        return view('quiz', compact('quiz', 'time', 'quizQuestions', 'authUserHasPlayedQuiz'));
    }

    public function postQuiz(Request $request)
    {
        $questionId = $request['questionId'];
        $answerId = $request['answerId'];
        $quizId = $request['quizId'];

        $authUser = auth()->user();

        /*
            In updateOrCreate
            Why should have 2 arrays of object because
            First line means check anything in first line
            Then the second line means update if exist, and create if doesn't exist
        */
        return $userQuestionAnswer = Result::updateOrCreate(
            ['user_id' => $authUser->id, 'quiz_id' => $quizId, 'question_id' => $questionId],
            ['answer_id' => $answerId]
        );
    }

    function viewResult($userId, $quizId)
    {
        $results = Result::where('user_id', $userId)->where('quiz_id', $quizId)->get();
        //dd($results);
        return view('result-detail', compact('results'));
    }

    public function result()
    {
        $quizzes = Quiz::get();
        return view('backend.result.index', compact('quizzes'));
    }

    public function userQuizResult($userId, $quizId)
    {
        $results = Result::where('user_id', $userId)->where('quiz_id', $quizId)->get();
        $totalQuestions = Question::where('quiz_id', $quizId)->count();
        $attemptQuestions = $results->count();
        $ans = [];
        foreach($results as $answer){
            array_push($ans, $answer->answer_id);
        }
        $userCorrectedAnswers = Answer::whereIn('id', $ans)->where('is_correct', 1)->count();
        $userWrongAnswers = 0;
        $percentage = 0;
        if($attemptQuestions){
            $percentage = ($userCorrectedAnswers/$totalQuestions)*100;
            $userWrongAnswers = $totalQuestions - $userCorrectedAnswers;
        }
        $quiz = Quiz::where('id', $quizId)->first();
        return view('backend.result.result', compact('results', 'totalQuestions', 'attemptQuestions', 'userCorrectedAnswers', 'userWrongAnswers', 'percentage', 'quiz'));
        //dd($percentage);
    }
}
