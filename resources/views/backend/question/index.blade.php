@extends('backend.layouts.master')

@section('title', 'Show Question')
    
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
                    <h3>Tables</h3>
                </div>
                <div class="module-body">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Question</th>
                        <th>Quiz</th>
                        <th>Created</th>
                        <th></th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($questions)>0)
                            @foreach ($questions as $key=>$question)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $question->question_name }}</td>
                                    <td>{{ $question->quiz->quiz_name }}</td>
                                    <td>{{ date('F d,Y', strtotime($question->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('question.show', [$question->question_id]) }}" class="btn btn-info">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('question.edit', [$question->question_id]) }}" class="btn btn-success">Edit</a>
                                    </td>
                                    <td>
                                        <form id="delete-form{{ $question->question_id }}" method="POST" action="{{ route('question.destroy', [$question->question_id]) }}">
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
                                    </td>
                                </tr>  
                            @endforeach
                        @else
                            <td>No question to display</td>
                        @endif
                    </tbody>
                    </table>
                    <div class="pagination pagination-centered">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection