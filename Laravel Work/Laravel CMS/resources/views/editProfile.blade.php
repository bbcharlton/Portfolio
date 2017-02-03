@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Home</a>
        /
        <a class="breadcrumb-item active" href="{{url('profile')}}/{{$user->firstname}}.{{$user->lastname}}/{{$user->id}}">{{ $user->firstname }} {{ $user->lastname }}'s Profile</a>
        /
        <a class="breadcrumb-item active" href="{{url('profile/edit')}}/{{$user->id}}">Edit Profile</a>
    </nav>

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit user
        </div>

        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="/profile/edit/{{ $user->id }}" enctype="multipart/form-data">
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

                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    <label for="image" class="col-md-4 control-label">Upload Profile Image</label>

                    <div class="col-md-6">
                        <input type="file" id="image" class="form-control" name="image">

                        @if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @if($user->profilePicURL)
                    <div class="form-group">
                        <label for="currentImg" class="col-md-4 control-label">Current Image</label>

                        <div class="col-md-6 col-md-offset-4">
                            <img src="/{{ $user->profilePicURL }}" class="img-responsive" id="currentImg" style="width: 300px; height: 300px;">
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