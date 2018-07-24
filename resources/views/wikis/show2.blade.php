@extends('layouts.app')


@section('content')

	<div class="bg-white py-60 h-auto" style="min-height: 840px;">
		<div class="container md:mx-auto">
			<h2 class="text-black mb-35 font-semibold text-3xl border-t-0 border-x-0 border-b border-black pb-3">{{ $wiki->title }}</h2>
			<latex-editor source-url="/wiki/{{ $wiki->id }}/body"></latex-editor>

            <div class="container mt-45 wiki-rate-box w-full shadow-lg py-35 px-20 md:mx-auto bg-white border-4 border-brand border-l-0 border-b-0 border-r-0">

                    <div class="flex">
                        <span class="text-yellow text-2xl flex-1 tracking-wide mt-2"><span class="text-black font-semibold">Rate this wiki :</span> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></span>

                             <a href="http://127.0.0.1:8000/login" class="no-underline  bg-transparent tracking-wide hover:bg-orange text-orange font-semibold hover:text-white py-3 px-6 border-2 border-orange hover:border-transparent rounded mr-4">
                                              Mark as Read
                                </a>
                        </div>


            </div>
		</div>




	</div>

@endsection


