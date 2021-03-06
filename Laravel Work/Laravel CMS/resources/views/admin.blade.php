@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('home')}}">Home</a>
        /
        <a class="breadcrumb-item active" href="{{url('admin')}}">Admin</a>
    </nav>

    <div class="panel panel-default">
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
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#users">Users</a></li>
                <li><a data-toggle="tab" href="#posts">Posts</a></li>
            </ul>

            <div class="tab-content">
                <div id="users" class="tab-pane fade in active">
                    <a href="/admin/user/create" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> New User</a>
                    <span class="clearfix"></span>
                    <div class="table-responsive">          
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <div class="pull-left">
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>User Role</th>
                                        <th>Email</th>
                                    </div>

                                    <div class="pull-right">
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </div>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <div class="pull-left">
                                            <td>{{ $user->id }}</td>
                                            <td><a href="/profile/{{ $user->firstname }}.{{ $user->lastname }}/{{ $user->id }}">{{ $user->firstname . ' ' . $user->lastname }}</a></td>
                                            <td>{{ $user->user_role }}</td>
                                            <td>{{ $user->email }}</td>
                                        </div>

                                        <div class="pull-right">
                                            @if($user->user_role == 'admin')
                                                <td><s>Edit</s></td>
                                                <td><s>Delete</s></td>
                                            @else
                                                <td><a href="{{ url('/admin/user/edit/' . $user->id) }}">Edit</a></td>
                                                <td><a href="{{ url('/admin/user/delete/' . $user->id) }}">Delete</a></td>
                                            @endif
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                      </table>
                    </div>
                </div>

                <div id="posts" class="tab-pane fade">
                    <a href="/posts/create" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> New Post</a>
                    <span class="clearfix"></span>
                    <div class="table-responsive">          
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <div class="pull-left">
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                    </div>

                                    <div class="pull-right">
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </div>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <div class="pull-left">
                                            <td>{{ $post->id }}</td>
                                            <td><a href="post/{{ $post->id }}">{{ $post->title }}</a></td>
                                            <td><a href="profile/{{ $users->where('id', $post->poster_id)->first()->firstname }}.{{ $users->where('id', $post->poster_id)->first()->lastname }}/{{ $users->where('id', $post->poster_id)->first()->id }}">{{ $users->where('id', $post->poster_id)->first()->firstname }}</td>
                                            <td>{{ $post->created_at }}</td>
                                            <td>{{ $post->updated_at }}</td>
                                        </div>

                                        <div class="pull-right">
                                            <td><a href="{{ url('/posts/edit/' . $post->id) }}">Edit</a></td>
                                            <td><a href="{{ url('/posts/delete/' . $post->id) }}">Delete</a></td>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection