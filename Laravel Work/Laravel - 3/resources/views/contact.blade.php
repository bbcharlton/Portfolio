@extends('layouts.app')

@section('title', 'Contact')

@section('content')
	<h1>Contact</h1>

	@if(count($errors) > 0)
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	@endif

	{!! Form::open(['action' => 'RootController@store']) !!}
		{!! Form::label('name', 'Name:') !!}
		{!! Form::text('name') !!}

		{!! Form::label('email', 'Email:') !!}
		{!! Form::email('email') !!}

		{!! Form::label('msg', 'Message:') !!}
		{!! Form::textarea('msg') !!}

		{!! Form::submit('Submit') !!}
	{!! Form::close() !!}
@endsection