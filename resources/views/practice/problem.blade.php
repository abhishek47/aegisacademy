@extends('layouts.app')

@section('content')
    <div class="bg-grey-lighter flex" style="min-height: 100vh;">

        <div class="container md:mx-auto mt-8">
            <div class="flex flex-col shadow-md rounded bg-white p-4 mb-6">
                <span class="text-blue-dark text-sm font-semibold tracking-wide">
                <a href="/practice/{{ $subject->slug }}" class="no-underline text-blue-dark hover:text-brand">
                 {{ $subject->name }}
                </a>
                <i class="fa fa-chevron-right text-grey-dark"></i>
                <a href="/practice/{{ $subject->slug }}/topic:{{$topic->id}}" class="no-underline text-blue-dark hover:text-brand">
                 {{ $topic->name }}
                </a>
                <i class="fa fa-chevron-right text-grey-dark"></i>  <span class="text-grey-darker">{{ $problem->title }}</span>
              </span>
            </div>
            <div class="flex flex-col shadow-md rounded bg-white p-4 border-4 border-brand border-l-0 border-b-0 border-r-0">
                <div class="flex border border-grey-dark border-l-0 border-t-0 border-r-0 pb-3">
                    <h3 class="flex-1 text-2xl font-semibold tracking-wide mt-1 ml-2">{{ $problem->title }}</h3>
                </div>

                <practice-problems problem-set="{{ $problem }}"></practice-problems>
            </div>


        </div>

    </div>
@endsection
