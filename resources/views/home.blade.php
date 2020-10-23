@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <div class="card">
                <div class="card-header">Exam</div>
                @if ($isExamAssigned)
                    @foreach ($quizzes as $quiz)
                        <div class="card-body">
                            <p><h3>{{ $quiz->quiz_name }}</h3></p>
                            <p>About Exam : {{ $quiz->quiz_description }}</p>
                            <p>Time allocated : {{ $quiz->quiz_minutes }} minutes</p>
                            <p>Number of questions : {{ $quiz->questions->count() }}</p>
                            <p>
                                @if (!in_array($quiz->id, $wasQuizCompleted))
                                    <a href="/user/quiz/{{ $quiz->quiz_id }}" class="btn btn-success">Start Quiz</a>
                                @else
                                    <a href="/result/user/{{ auth()->user()->user_id }}/quiz/{{ $quiz->quiz_id }}">View Result</a>
                                    <span class="float-right"><b>Completed</b></span>
                                @endif
                            </p>
                        </div>
                    @endforeach
                @else
                    <p>You have not assigned any exam</p>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">User Profile</div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ auth()->user()->user_email }}</td>
                        </tr>
                        <tr>
                            <td>Occupation</td>
                            <td>:</td>
                            <td>{{ auth()->user()->user_occupation }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>{{ auth()->user()->user_address }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td>{{ auth()->user()->user_phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
