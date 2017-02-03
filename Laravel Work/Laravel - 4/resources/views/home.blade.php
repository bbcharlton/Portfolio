@extends('layouts.app')

@section('title', 'Home')

@section('header')
	@parent
	<p>This is appended to the master header</p>
@endsection

@section('content')
	@if ($loggedIn)
		<h1>Welcome!</h1>
	@else
		<h1>Join us!</h1>
	@endif

	<p>This is my body content.</p>
	<ul>
		@foreach ($users as $user)
			<li>This is user {{ $user }}</li>
		@endforeach
	</ul>

	<ul>
		@each('part.user', $users, 'user')
	</ul>
@endsection