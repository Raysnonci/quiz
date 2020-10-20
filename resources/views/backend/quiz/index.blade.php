@extends('backend.layouts.master')

@section('title', 'Create Quiz')
    
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>Minutes</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($quizzes)>0)
                            @foreach ($quizzes as $key=>$quiz)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $quiz->name }}</td>
                                    <td>{{ $quiz->description }}</td>
                                    <td>{{ $quiz->minutes }}</td>
                                    <td>
                                        <a href="{{ route('quiz.show', [$quiz->id]) }}" class="btn btn-inverse">View Questions</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('quiz.edit', [$quiz->id]) }}" class="btn btn-success">Edit</a>
                                    </td>
                                    <td>
                                        <form id="delete-form{{ $quiz->id }}" method="POST" action="{{ route('quiz.destroy', [$quiz->id]) }}">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            {{-- <a href="#" class="btn btn-danger">Delete</a> --}}
                                            <input type="submit" value="Delete" class="btn btn-danger" onclick="if(confirm('Do you want to delete?'))
                                            {
                                                event.preventDefault();
                                                document.getElementById('delete-form{{ $quiz->id }}').submit()
                                            }else{
                                                event.preventDefault();
                                            }
                                            ">
                                        </form>
                                    </td>
                                </tr>  
                            @endforeach
                        @else
                            <td>No quiz to display</td>
                        @endif
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection