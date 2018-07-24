@extends('layouts.app')



@section('content')



	<div class="bg-grey-lightest pb-60 pt-45" style="min-height: 850px;">
		<div class="container mx-auto">



			<div class="flex">
				<div class="w-1/4 p-3 pl-0 pt-0">
					<div class="bg-white rounded shadow">
						<div class="bg-brand">
							<h4 class="text-white font-semibold pt-4 pb-4 pl-4 text-lg tracking-wide">Topics</h4>
						</div>
						<hr class="border m-0 p-0">
						<ul class="list-reset flex flex-col">

							<li class="{{ $categoryId == null ? 'bg-grey-lighter' : '' }} p-4 hover:bg-grey-lighter cursor-pointer border-x-0 border-t-0 border-b border-grey-light" >
								<a class="block w-full no-underline text-grey-darker text-md font-semibold tracking-wide" href="/wiki">
								 <i class="fa fa-circle text-grey-darker text-xs mr-2"></i> All
								</a>
							</li>

							@foreach($categories as $category)

							<li class="{{ $categoryId == $category->id ? 'bg-grey-lighter' : '' }} p-4 hover:bg-grey-lighter cursor-pointer border-x-0 border-t-0 border-b border-grey-light" >
								<a class="block w-full no-underline text-grey-darker text-md font-semibold tracking-wide" href="/wiki/category:{{$category->id}}">
								 <i class="fa fa-circle text-xs mr-2" style="color: {{ $category->color->code  }} "></i> {{ $category->name }}
								</a>
							</li>

							@endforeach


						</ul>

					</div>
				</div>
				<div class="w-3/4 p-3 pt-0">
					<div class="flex flex-col">

						<?php $articleChunks = $articles->chunk(2); ?>

						@foreach($articleChunks as $articlesList)

							<div class="flex">
								@foreach($articlesList as $article)

									 <a href="{{ url($article->url)}}" class="no-underline text-black w-1/2 pr-6 mb-8">
						                <div class="rounded shadow-md bg-white p-6 pt-4 border-t-4 border-b-0 border-r-0 border-l-0 border-brand">
						                    <span class="rounded p-1 px-4 text-white tracking-wide text-xs" style="background-color: {{ $article->category->color->code }}">{{ $article->category->name }}</span>
						                    <h3 class="w-full text-xl font-normal tracking-normal leading-normal mt-4 mb-4">{{ str_limit($article->title, 30) }}</h3>
						                    <div class="flex flex-end">
						                     <span class="flex-1 text-grey-darker"><i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i>  </span>
						                     <span class="text-grey-darker"><i class="fa fa-clock"></i> {{ $article->created_at->format('jS M Y')}}</span>
						                    </div>
						                </div>
						            </a>


					            @endforeach
							</div>

						@endforeach

						<div>
							{!! $articles->links() !!}
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>

@endsection