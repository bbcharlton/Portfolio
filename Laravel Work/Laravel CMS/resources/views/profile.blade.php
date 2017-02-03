@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Home</a>
        /
        <a class="breadcrumb-item active" href="{{'profile/' + $user->firstname + '.' + $user->lastname + '/' + $user->id}}">{{ $user->firstname }} {{ $user->lastname }}'s Profile</a>
    </nav>

    <div class="panel panel-default">
        @if(Session::has('permission-message'))
            <div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('permission-message') }}
            </div>
        @endif

        @if(Session::has('success-message'))
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('success-message') }}
            </div>
        @endif

        @if(Session::has('failure-message'))
            <div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('failure-message') }}
            </div>
        @endif

        <div class="panel-body">
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                @if($user->profilePicURL)
                    <img src="/{{ $user->profilePicURL }}" class="img-responsive" style="width: 200px; height: 200px;">
                @else
                    <img src="/profileImages/default.jpg"  class="img-responsive" style="width: 200px; height: 200px;">
                @endif

                @if($user->id == Auth::id())
                    <a href="/profile/edit/{{ $user->id }}" class="pull-left btn btn-primary" style="margin-top: 15px;">Edit Profile</a>
                @endif
                <span class="clearfix"></span>
                <h3>{{ $user->firstname }} {{ $user->lastname }}</h3>
                <hr class="pull-left" style="width: 200px;">
            </div>

            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                @if($user->id == Auth::id())
                    <form role="form" method="POST" action="{{ url('/profile/status/create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="control-label">Create Status</label>

                            <div class="input-group">
                                <input type="text" id="status" class="form-control" name="status" style="height: 50px;" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit" style="height: 50px;">Post</button>
                                </span>
                            </div>

                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </form>
                @endif

                <span class="clearfix"></span>

                @if(count($statuses) == 0)
                    <h3>This user hasn't posted any content</h3>
                @endif

                @foreach($statuses as $status)
                    @if($status->user_id == $user->id)
                        <div class="panel-group">
                            <div class="panel">
                                <div class="panel-heading">
                                    <p class="status">{{ $status->text }}</p>
                                    @if($user->id == Auth::id() || Auth::user()->user_role == 'admin')
                                        <a href="/profile/status/delete/{{ $status->id }}" class="btn btn-primary glyphicon glyphicon-trash pull-right"></a>
                                    @endif
                                    <span class="clearfix"></span>
                                </div>

                                <p class="text-right" style="margin-right: 15px;">Posted: {{ $status->created_at }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection