@extends('layouts.app')

@section('content')

  <div class="bg-grey-lightest" style="min-height: 100vh;">
    <div class="container md:mx-auto pt-8 pl-45">

            <h2 class="font-semibold text-black tracking-wide text-4xl mb-60 mt-8">Choose a subject</h2>

            <div class="flex items-center justify-space-around flex-wrap mt-4">
                @foreach($subjects as $subject)
                    <a href="/practice/{{$subject->slug}}" class="border border-grey no-underline shadow-md rounded-lg flex bg-white mr-8 h-16 mb-8">
                        <img src="{{ url($subject->icon) }}" class="w-16 h-100 rounded-l border border-2 border-black">
                        <div class="p-3 pl-4 pr-45">
                            <h2 class="font-semibold tracking-wide text-black text-2xl mt-2">{{ $subject->name }}</h2>
                        </div>
                    </a>
                @endforeach
            </div>

    </div>
  </div>

@endsection