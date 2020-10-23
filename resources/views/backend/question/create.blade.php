@extends('backend.layouts.master')

@section('title', 'Create Quiz')
    
@section('content')

    <div class="span9">
        <div class="content">
            @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <form action="{{ route('question.store') }}" method="POST">
                @csrf
                <div class="module">
                    <div class="module-head">
                        <h3>Create Question</h3>
                    </div>
                    <div class="module-body">
                        <div class="control-group">
                            <label class="control-label">Choose Quiz</label>
                            <div class="controls">
                                <select name="quiz" class="span8">
                                    @foreach ($quizzes as $quiz)
                                        <option value="{{ $quiz->quiz_id }}">{{ $quiz->quiz_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="control-label">Question Name</label>
                            <div class="controls">
                                <input type="text" name="question" class="span8" placeholder="Name of the quiz" value="{{ old('question') }}">
                            </div>
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="control-label">Options</label>
                            <div class="controls">
                                @for ($i = 0; $i < 4; $i++)
                                    <input type="text" name="options[]" class="span7" placeholder="Option {{ $i+1 }}" value="{{ old('options.[$i]') }}" required>
                                    <input type="radio" name="correct_answer" value="{{ $i }}">
                                    <span>Is correct answer</span>
                                @endfor
                            </div>
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror


                            
                            <div class="controls">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection