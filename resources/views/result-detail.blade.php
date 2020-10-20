@extends('layouts.app')
    
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <center><h2>Your Results</h2></center>
                @foreach ($results as $key=>$result)
                    <div class="card" style="margin-bottom: 20px;">
                        <div class="card-header">
                            {{ $key+1 }}
                        </div>

                        <div class="card-body">
                            <p>
                                <h3>{{ $result->question->question }}</h3>
                            </p>

                            @php
                                $alphabets = range('A', 'D');
                                $answers = DB::table('answers')->where('question_id', $result->question_id)->get();
                            @endphp
                            @foreach ($answers as $ans => $answer)
                                <p>
                                    {{ $alphabets[$ans] }}.) {{ $answer->answer }}
                                    @if ($answer->is_correct)
                                        <span class="badge badge-success">Correct Answer</span>
                                    @endif
                                </p>
                            @endforeach
                            
                            Your Answer: <mark>{{ $result->answer->answer }} </mark>
                            <p>
                                @if ($result->answer->is_correct)
                                    <span class="badge badge-success">Your answer is correct</span>
                                @else
                                    <span class="badge badge-danger">Your answer is wrong</span>
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
                <a href="/home" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
@endsection