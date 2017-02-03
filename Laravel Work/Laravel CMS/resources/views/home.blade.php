@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item active" href="{{url('home')}}">Home</a>
    </nav>

    @if(Session::has('permission-message'))
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('permission-message') }}
        </div>
    @endif

    @foreach($posts as $post)
        <div class="panel-group">
            <div class="panel">
                <h1 class="panel-heading">{{ $post->title }}</h1>
                <div class="panel-body">
                    <small>By: <a href="/profile/{{ $users->where('id', $post->poster_id)->first()->firstname }}.{{ $users->where('id', $post->poster_id)->first()->lastname }}/{{ $users->where('id', $post->poster_id)->first()->id }}">{{ $users->where('id', $post->poster_id)->first()->firstname }} {{ $users->where('id', $post->poster_id)->first()->lastname }}</a> / {{ $post->updated_at }}</small>
                    <h3>{{ $post->description }}</h3>
                    <a href="/post/{{ $post->id }}" class="btn btn-primary pull-right">Read Full Post</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection