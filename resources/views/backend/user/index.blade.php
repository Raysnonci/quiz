@extends('backend.layouts.master')

@section('title', 'Show User')
    
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
                        <th>E-mail</th>
                        <th>Password</th>
                        <th>Occupation</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th></th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users)>0)
                            @foreach ($users as $key=>$user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->user_name }}</td>
                                    <td>{{ $user->user_email }}</td>
                                    <td>{{ $user->user_visible_password }}</td>
                                    <td>{{ $user->user_occupation }}</td>
                                    <td>{{ $user->user_address }}</td>
                                    <td>{{ $user->user_phone }}</td>
                                    {{-- <td>
                                        <a href="{{ route('user.show', [$user->id]) }}" class="btn btn-info">View</a>
                                    </td> --}}
                                    <td>
                                        <a href="{{ route('user.edit', [$user->user_id]) }}" class="btn btn-success">Edit</a>
                                    </td>
                                    <td>
                                        <form id="delete-form{{ $user->id }}" method="POST" action="{{ route('user.destroy', [$user->user_id]) }}">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            {{-- <a href="#" class="btn btn-danger">Delete</a> --}}
                                            <input type="submit" value="Delete" class="btn btn-danger" onclick="if(confirm('Do you want to delete?'))
                                            {
                                                event.preventDefault();
                                                document.getElementById('delete-form{{ $user->id }}').submit()
                                            }else{
                                                event.preventDefault();
                                            }
                                            ">
                                        </form>
                                    </td>
                                </tr>  
                            @endforeach
                        @else
                            <td>No user to display</td>
                        @endif
                    </tbody>
                    </table>
                    <div class="pagination pagination-centered">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection