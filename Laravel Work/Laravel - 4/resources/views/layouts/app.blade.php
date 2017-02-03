<!doctype>
<html>
	<head>
		<title>Lecture 3 - @yield('title')</title>
		<style type="text/css">
			body * {
				display: block;
				padding: 10px;
				margin: 10px;
			}
		</style>
	</head>

	<body>
		<div style="background: gray">
			@section('header')
				This is the master header
			@show
		</div>

		<div>
			@yield('content')
		</div>
	</body>
</html>