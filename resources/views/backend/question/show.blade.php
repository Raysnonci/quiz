@extends('backend.layouts.master')

@section('title', 'View Question')
    
@section('content')
    <div class="span9">
        <div class="module">
            <div class="module-head">
                
            </div>

            <div class="module-body">
                <p><h3>{{ $question->question }}</h3></p>

                <div class="module-body table">
                    <table class="table table-message">
                        <tbody>
                            @php
                                $alphabets = range('A', 'D')
                            @endphp 
                            @foreach ($question->answers as $key=>$answer)
                                <tr class="read">
                                    <td class="cell-author hidden-phone hidden-tablet">
                                        {{ $alphabets[$key] }}. {{ $answer->answer_name }}

                                        @if ($answer->answer_is_correct==1)
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

                <div class="module-foot">
                    <a href="{{ route('question.edit', [$question->question_id]) }}" class="btn btn-light"><button class="btn btn-primary">Edit</button></a>
                    
                    <button class="btn btn-light">
                        <form id="delete-form{{ $question->question_id }}" method="POST" action="{{ route('question.destroy', [$question->id]) }}">
                            @csrf
                            {{ method_field('DELETE') }}
                            {{-- <a href="#" class="btn btn-danger">Delete</a> --}}
                            <input type="submit" value="Delete" class="btn btn-danger" onclick="if(confirm('Do you want to delete?'))
                            {
                                event.preventDefault();
                                document.getElementById('delete-form{{ $question->question_id }}').submit()
                            }else{
                                event.preventDefault();
                            }
                            ">
                        </form>
                    </button>
                    <a href="{{ route('question.index') }}" class="btn btn-light pull-right"><button class="btn btn-inverse">Back</button></a>
                </div>
            </div>
        </div>
    </div>

@endsection