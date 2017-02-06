{!! Form::open(['url' => '/users']) !!}
	<div>
		{!! Form::label('name', 'Name') !!}
		{!! Form::text('name') !!}
	</div>

	<div>
		{!! Form::label('email', 'Email') !!}
		{!! Form::email('email') !!}
	</div>

	<div>
		{!! Form::label('password', 'Password') !!}
		{!! Form::password('password') !!}
	</div>

	{!! Form::submit('Save') !!}
{!! Form::close() !!}