@extends('layouts.app')


@section('content')

	<div class="bg-white py-60 h-auto" style="min-height: 840px;">
		<div class="container md:mx-auto">
			<h2 class="text-black mb-35 font-semibold text-3xl border-t-0 border-x-0 border-b border-black pb-3"><i id="isReadCheck" class="fa fa-check-circle text-green" v-show="{{ auth()->user()->hasRead($wiki) }}"></i>   {{ $wiki->title }}</h2>
			<latex-editor source-url="/wiki/{{ $wiki->id }}/body"></latex-editor>

            <div class="container mt-45 wiki-rate-box w-full shadow-lg py-35 px-20 md:mx-auto bg-white border-4 border-brand border-l-0 border-b-0 border-r-0">

                    <div class="flex">
                        <span class="text-black text-2xl flex-1 tracking-wide mt-0 font-semibold">
                        <rate-wiki id="{{$wiki->id}}" :edit="true" user-rating="{{ auth()->user()->ratingFor($wiki) }}"></rate-wiki>
                        </span>

                             <mark-as-read is-read="{{ auth()->user()->hasRead($wiki) }}"  id="{{ $wiki->id }}"></mark-as-read>
                        </div>


            </div>
		</div>




	</div>

@endsection


