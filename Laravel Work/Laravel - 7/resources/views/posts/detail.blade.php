<a href="/posts">Back to Posts</a>

<h1>{{$title}}</h1>
<p>{{$content}}</p>

<a href="/posts/{{$id}}/edit">Edit</a>
<a href="/posts/{{$id}}/destroy">Delete</a>

{!! Form::open(['url' => '/comments']) !!}
	{!! Form::hidden('post_id', $id) !!}
	<div>
		{!! Form::label('content', 'Comment') !!}
		{!! Form::textarea('content') !!}
	</div>

	{!! Form::submit('Save') !!}
{!! Form::close() !!}

@if(isset($comments))
	@foreach($comments as $comment)
		<p>{{$comment['content']}}</p>
		<p>---- {{$comment['user']['name']}}</p>
	@endforeach
@endif