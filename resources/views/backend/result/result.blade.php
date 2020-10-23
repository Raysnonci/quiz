@extends('backend.layouts.master')

@section('title', 'View Result')
    
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
                    <h3>View Result</h3>
                </div>
                <div class="module-body">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Test</th>
                        <th>Total Question</th>
                        <th>Attempt Question</th>
                        <th>Correct Answer</th>
                        <th>Wrong Answer</th>
                        <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $quiz->quiz_name }}</td>
                            <td>{{ $totalQuestions }}</td>
                            <td>{{ $attemptQuestions }}</td>
                            <td>{{ $userCorrectedAnswers }}</td>
                            <td>{{ $userWrongAnswers }}</td>
                            <td>{{ round($percentage) }}</td>
                        </tr>  
                    </tbody>
                    </table>
                </div>
            </div>

            <div class="module">
                <div class="module-head">
                    <h3>View User Results</h3>
                </div>
                <div class="module-body">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $key=>$result)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $result->question->question_name }}</td>
                                <td>{{ $result->answer->answer_name }}</td>
                                @if ($result->answer->answer_is_correct)
                                    <td style="color: green;">Correct</td>
                                @else
                                    <td style="color: red;">Wrong</td>
                                @endif
                            </tr>  
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection