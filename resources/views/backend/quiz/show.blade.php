@extends('backend.layouts.master')

@section('title', 'View Question')
    
@section('content')
    <div class="span9">
        <div class="module">
            <div class="module-head">
                {{ $quiz->name }}
            </div>

            <div class="module-body">
                @if (count($quiz->questions)>0)
                    @foreach ($quiz->questions as $number => $question)
                        <p><h3>{{ $number+1 }}. {{ $question->question }}</h3></p>

                        <div class="module-body table">
                            <table class="table table-message">
                                <tbody>
                                    @php
                                        $alphabets = range('A', 'D')
                                    @endphp 
                                    @foreach ($question->answers as $key=>$answer)
                                        <tr class="read">
                                            <td class="cell-author hidden-phone hidden-tablet">
                                                {{ $alphabets[$key] }}. {{ $answer->answer }}

                                                @if ($answer->is_correct==1)
                                                    <span class="badge badge-success pull-right">
                                                        <b>Correct</b>
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @else
                    <h3>No Question to display</h3>
                @endif

                <div class="module-foot">
                    <a href="{{ route('quiz.index') }}" class="btn btn-inverse">Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection