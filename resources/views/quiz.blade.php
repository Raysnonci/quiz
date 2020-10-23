@extends('layouts.app')

@section('content')
    <quiz-component
    :times = "{{ $quiz->quiz_minutes }}"
    :quiz-id = "{{ $quiz->quiz_id }}"
    :quiz-questions = "{{ $quizQuestions }}"
    :has-quiz-played = "{{ $authUserHasPlayedQuiz }}"
    >
    
    </quiz-component>

    <script>
        window.oncontextmenu = function(){
            console.log("Right Click Disabled");
            return false;
        }
    </script>
    {{-- <example-component></example-component> --}}
@endsection