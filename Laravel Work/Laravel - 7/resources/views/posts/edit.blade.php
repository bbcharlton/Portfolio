{!! Form::model($post, ['route' => ['posts.update', $post], 'method' => 'put']) !!}
	<div>
		{!! Form::label('title', 'Title') !!}
		{!! Form::text('title') !!}
	</div>

	<div>
		{!! Form::label('content', 'Post') !!}
		{!! Form::textarea('content') !!}
	</div>

	{!! Form::submit('Save') !!}
{!! Form::close() !!}