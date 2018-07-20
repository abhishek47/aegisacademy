@extends('layouts.app')


@section('content')

	<div class="container">
		
		<!-- Article Title -->
		<div class="d-flex justify-content-between">
			<h2 class="font-weight-bold">{{ $wiki->title }}</h2>
			<portal-target name="edit-link"></portal-target>
		</div>
		<hr>

		<latex-editor source-url="/wiki/{{ $wiki->id }}/body"></latex-editor>

	</div>

@endsection


