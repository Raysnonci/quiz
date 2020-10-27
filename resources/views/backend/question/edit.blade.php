@extends('backend.layouts.master')

@section('title', 'Update Question')
    
@section('content')

    <div class="span9">
        <div class="content">
            @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <form action="{{ route('question.update', [$question->question_id]) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="module">
                    <div class="module-head">
                        <h3>Edit Question</h3>
                    </div>
                    <div class="module-body">
                        <div class="control-group">
                            <label class="control-label">Quiz name</label>
                            <div class="controls">
                                <select name="quiz" class="span8">
                                    @foreach (App\Quiz::all() as $quiz)
                                        <option value="{{ $quiz->quiz_id }}"
                                            @if ($question->quiz->quiz_id == $quiz->quiz_id)
                                                selected
                                            @endif>{{ $quiz->quiz_name }}</option>
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
                                <input type="text" name="question" class="span8" placeholder="Name of the quiz" value="{{ $question->question_name }}">
                            </div>
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                                
                            <label class="control-label">Options</label>
                            <div class="controls">
                                @foreach ($question->answers as $key=>$answer)
                                    <input type="text" name="options[]" class="span7" value="{{ $answer->answer_name }}">
                                    <input type="radio" name="correct_answer" value="{{ $key }}" {{ $answer->answer_is_correct? 'checked':'' }}>
                                    <span>Is correct answer</span>
                                @endforeach
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