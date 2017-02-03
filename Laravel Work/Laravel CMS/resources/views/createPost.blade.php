@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Home</a>
        /
        <a class="breadcrumb-item" href="{{url('posts')}}">Posts</a>
        /
        <a class="breadcrumb-item active" href="{{url('posts/create')}}">Create Post</a>
    </nav>

    <div class="panel panel-default">
        <div class="panel-heading">
            Create post
        </div>

        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/posts/add') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-4 control-label">Title</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-md-4 control-label">Description</label>

                    <div class="col-md-6">
                        <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus>

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                    <label for="body" class="col-md-4 control-label">Body</label>

                    <div class="col-md-6">
                        <textarea id="body" class="form-control" style="height: 200px" name="body" required></textarea>

                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    <label for="image" class="col-md-4 control-label">Upload Image</label>

                    <div class="col-md-6">
                        <input type="file" id="image" class="form-control" name="image">

                        @if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary pull-right">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection