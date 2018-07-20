@extends('layouts.app')



@section('content')

	<div class="container">
		<div class="row mb-4">
			@foreach($articles as $article)
				
				<div class="col-md-6 mb-3">
					<div class="card">
						<div class="card-body">
							<span class="badge {{ $article->category->id % 2 != 0 ? 'badge-success' : 'badge-danger' }}">{{ $article->category->name }}</span>
							<span class="float-right text-grey">{{ $article->created_at->diffForHumans() }}</span>
							<h3 class="mb-3 mt-2">{{ $article->title }}</h3>

							<a href="{{ $article->url }}" class="btn btn-sm btn-primary">Read Full</a>
						</div>
					</div>
				</div>	

			@endforeach
		</div>

		{!! $articles->links() !!}
	</div>

@endsection