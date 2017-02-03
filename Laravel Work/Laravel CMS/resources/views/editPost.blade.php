@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Home</a>
        /
        <a class="breadcrumb-item" href="{{url('posts')}}">Posts</a>
        /
        <a class="breadcrumb-item active" href="{{url('posts/edit/')}}/{{$post->id}}">Edit Post</a>
    </nav>

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit post
        </div>

        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="/posts/edit/{{ $post->id }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-4 control-label">Title</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control" name="title" value="{{ $post->title }}" required autofocus>

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
                        <input id="description" type="text" class="form-control" name="description" value="{{ $post->description }}" required autofocus>

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
                        <textarea id="body" class="form-control" style="height: 200px" name="body" required>{{ $post->body }}</textarea>

                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('newImg') ? ' has-error' : '' }}">
                    <label for="newImg" class="col-md-4 control-label">Upload Image</label>

                    <div class="col-md-6">
                        <input type="file" id="newImg" class="form-control" name="newImg">

                        @if ($errors->has('newImg'))
                            <span class="help-block">
                                <strong>{{ $errors->first('newImg') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @if($post->imageURL)
                    <div class="form-group">
                        <label for="currentImg" class="col-md-4 control-label">Current Image</label>

                        <div class="col-md-6 col-md-offset-4">
                            <img src="/{{ $post->imageURL }}" class="img-responsive" id="currentImg" style="width: 300px; height: 300px;">
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