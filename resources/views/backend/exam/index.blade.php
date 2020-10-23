@extends('backend.layouts.master')

@section('title', 'Exam Assigned User')
    
@section('content')
    <div class="span9">
        <div class="content">
            @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            @if(Session::has('message_r'))
                <div class="alert alert-danger">{{ Session::get('message_r') }}</div>
            @endif
            <div class="module">
                <div class="module-head">
                    <h3>User Exam</h3>
                </div>
                <div class="module-body">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Quiz</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $key=0
                        @endphp
                        @if (count($quizzes)>0)
                            @foreach ($quizzes as $quiz)
                                @foreach ($quiz->users as $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $user->user_name }}</td>
                                        <td>{{ $quiz->quiz_name }}</td>
                                        <td>
                                            <a href="{{ route('quiz.show', [$quiz->quiz_id]) }}" class="btn btn-inverse">View Questions</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('exam.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                                <input type="hidden" name="quiz_id" value="{{ $quiz->quiz_id }}">
                                                <button class="btn btn-danger" type="submit">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @else
                            <td>No user to display</td>
                        @endif
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection