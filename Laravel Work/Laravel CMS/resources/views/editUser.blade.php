@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Home</a>
        /
        <a class="breadcrumb-item" href="{{url('admin')}}">Admin</a>
        /
        <a class="breadcrumb-item active" href="{{url('admin/user/edit/')}}/{{$user->id}}">Edit User</a>
    </nav>

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit user
        </div>

        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="/admin/user/edit/{{ $user->id }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                    <label for="firstname" class="col-md-4 control-label">First Name</label>

                    <div class="col-md-6">
                        <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" required autofocus>

                        @if ($errors->has('firstname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                    <label for="lastname" class="col-md-4 control-label">Last Name</label>

                    <div class="col-md-6">
                        <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->lastname }}" required autofocus>

                        @if ($errors->has('lastname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @if(Auth::user()->user_role == 'admin')
                    <div class="form-group{{ $errors->has('user_role') ? ' has-error' : '' }}">
                        <label for="user_role" class="col-md-4 control-label">User Role</label>

                        <div class="col-md-6">
                            <select id="user_role" class="form-control" name="user_role" required>
                                <option>user</option>
                                <option>editor</option>
                                <option>admin</option>
                            </select>
                            
                            @if ($errors->has('user_role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user_role') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary pull-right">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection