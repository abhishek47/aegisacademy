@extends('layouts.app')


@section('content')

	<div class="container">
		
		<!-- Article Title -->
		<h2 class="font-weight-bold">{{ $wiki->title }}</h2>

		<hr>

		<latex-editor source-url="/wiki/{{ $wiki->id }}/body"></latex-editor>

	</div>

@endsection


