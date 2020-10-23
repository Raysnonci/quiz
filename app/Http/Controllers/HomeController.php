<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->user_is_admin == 1)
        {
            return redirect('/');
        }
        $authUser = auth()->user()->user_id;
        $assignedQuizId = [];
        $user = DB::table('quiz_user')->where('quiz_user_user_id', $authUser)->get();
        foreach ($user as $u) {
            array_push($assignedQuizId, $u->quiz_id);
        }
        $quizzes = Quiz::whereIn('quiz_id', $assignedQuizId)->get();//where ngebandingin satu data, klo whereIn ngebandingin array

        $isExamAssigned = DB::table('quiz_user')->where('quiz_user_user_id', $authUser)->exists();
        $wasQuizCompleted = Result::where('result_user_id', $authUser)->whereIn('result_quiz_id', (new Quiz())->hasQuizAttempted())->pluck('result_quiz_id')->toArray();

        return view('home', compact('quizzes', 'wasQuizCompleted', 'isExamAssigned'));
    }
}
