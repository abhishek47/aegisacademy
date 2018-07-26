@extends('layouts.app')

@section('content')
    <div class="bg-grey-lightest">
      <div class="flex bg-white shadow container md:mx-auto" style="min-height: 800px;">

          @include('discussions._sidebar')
          <div class="w-3/4 p-6 pl-8">
                <span class="text-grey-dark text-md font-semibold tracking-wide">{{ isset($threadgroup) ? $threadgroup : 'All Threads'}}</span>
                @foreach($discussions as $discussion)
                   @include('discussions._discussion')
                @endforeach
          </div>
      </div>
    </div>

     @include('discussions.new-modal')
@endsection