@extends('layout')
@section('title', 'Home Page')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="{{ asset('page-css/terminal.css') }}">
	<script src="{{ asset('page-js/terminal.js') }}" defer></script>
	<title>Home Page</title>
</head>
<body>
<div id="wrapper">
	<div class="console">
		<div class="console-history">
		</div>
		<input class="console-input" type="text" autofocus spellcheck="false" autocomplete="on">
	</div>
</div>
</body>
</html>
@endsection