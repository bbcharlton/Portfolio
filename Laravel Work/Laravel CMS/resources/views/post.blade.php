@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Home</a>
        /
        <a class="breadcrumb-item active" href="{{url('post')}}/{{$post->id}}">{{ $post->title }}</a>
    </nav>

    @if(Session::has('permission-message'))
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('permission-message') }}
        </div>
    @endif

    <div class="panel-group">
        <div class="panel">
            <h1 class="panel-heading">{{ $post->title }}</h1>
            <div class="panel-body">
                <small>By: <a href="/profile/{{ $users->where('id', $post->poster_id)->first()->firstname }}.{{ $users->where('id', $post->poster_id)->first()->lastname }}/{{ $users->where('id', $post->poster_id)->first()->id }}">{{ $users->where('id', $post->poster_id)->first()->firstname }} {{ $users->where('id', $post->poster_id)->first()->lastname }}</a> / {{ $post->updated_at }}</small>
                <h3>{{ $post->description }}</h3>
                <div class="row">
                    <p class="col-xs-12 col-sm-12 col-md-8 col-lg-8">{!! nl2br(e($post->body)) !!}</p>
                    @if($post->imageURL)
                        <img class="img-responsive col-12 col-md-4 col-lg-4" style="width: 300px; height: 300px;" src="/{{ $post->imageURL }}">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection