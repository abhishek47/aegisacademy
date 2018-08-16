@extends('layouts.app')


@section('content')

	<div class="bg-grey-lighter h-auto" style="min-height: 100vh;">
		<div class="bg-white shadow-md container p-3 px-6 pt-4 md:mx-auto">

            <span class="text-blue-dark text-sm font-semibold tracking-wide block mb-2 ml-1">
                <a href="/wiki/category:{{$wiki->category->id}}" class="no-underline text-blue-dark hover:text-brand">
                 {{ $wiki->category->name }}
                </a>
                <i class="fa fa-chevron-right text-grey-dark"></i> <span class="text-grey-darker">{{ $wiki->title }}</span>
            </span>

			<h2 class="text-black mb-35 font-semibold text-3xl pt-4 border-t-0 border-x-0 border-b border-black pb-3"><i id="isReadCheck" class="fa fa-check-circle text-green" v-show="{{ auth()->user()->hasRead($wiki) }}"></i>   {{ $wiki->title }}</h2>
			<latex-editor source-url="/wiki/{{ $wiki->id }}/body"></latex-editor>

            <div class="container mt-45 wiki-rate-box w-full shadow-lg py-35 px-20 md:mx-auto bg-white border-4 border-brand border-l-0 border-b-0 border-r-0">

                    <div class="flex">
                        <span class="text-black text-xl flex-1 tracking-wide mt-0 font-semibold">
                        <rate-wiki id="{{$wiki->id}}" size="30" :edit="true" user-rating="{{ auth()->user()->ratingFor($wiki) }}"></rate-wiki>
                        </span>

                             <mark-as-read is-read="{{ auth()->user()->hasRead($wiki) }}"  id="{{ $wiki->id }}"></mark-as-read>
                        </div>


            </div>
		</div>




	</div>

@endsection


