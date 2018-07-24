@extends('layouts.app')


@section('content')

	<div class="bg-white py-60 h-auto" style="min-height: 840px;">
		<div class="container md:mx-auto">
			<h2 class="text-black mb-35 font-semibold text-3xl border-t-0 border-x-0 border-b border-black pb-3">{{ $wiki->title }}</h2>



			<latex-editor source-url="/wiki/{{ $wiki->id }}/body"></latex-editor>
		</div>




	</div>

@endsection


