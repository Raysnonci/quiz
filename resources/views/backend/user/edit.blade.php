@extends('backend.layouts.master')

@section('title', 'Create User')
    
@section('content')

    <div class="span9">
        <div class="content">
            @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <form action="{{ route('user.update', [$user->user_id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="module">
                    <div class="module-head">
                        <h3>Update User</h3>
                    </div>
                    <div class="module-body">
                        <div class="control-group">
                            <label class="control-label">Name</label>
                            <div class="controls">
                                <input type="text" name="name" class="span8" value="{{ old('name')? old('name'):$user->user_name }}">
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        
                            <label class="control-label">E-mail</label>
                            <div class="controls">
                                <input type="email" name="email" class="span8" value="{{ $user->user_email }}" readonly>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="control-label">Password</label>
                            <div class="controls">
                                <input type="text" name="password" class="span8" value="{{ old('password')? old('password'):$user->user_visible_password }}"> 
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="control-label">Occupation</label>
                            <div class="controls">
                                <input type="text" name="occupation" class="span8" value="{{ old('occupation')? old('occupation'):$user->user_occupation }}"> 
                            </div>
                            @error('occupation')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="control-label">Address</label>
                            <div class="controls">
                                <input type="text" name="address" class="span8" value="{{ old('address')? old('address'):$user->user_address }}"> 
                            </div>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="control-label">Phone</label>
                            <div class="controls">
                                <input type="number" name="phone" class="span8" value="{{ old('phone')? old('phone'):$user->user_phone }}"> 
                            </div>
                            @error('phone')
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