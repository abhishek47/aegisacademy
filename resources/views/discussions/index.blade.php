@extends('layouts.app')

@section('content')
    <div class="bg-grey-lightest">
      <div class="flex bg-white shadow container md:mx-auto" style="min-height: 100vh;">

          @include('discussions._sidebar')
          <div class="w-3/4 p-6 pl-8">


                <form class="flex w-full mx-auto bg-white shadow-md rounded border-2 border-grey mb-6">

                      <i class="fa fa-search text-xl ml-3" style="color: #8795a185;margin-top: 10px;"></i>
                      <input type="text" class="w-full p-2 pt-1 mt-1 text-grey-dark" value="{{ request('query') }}" autocomplete="off" placeholder="Type something..." name="query" style="font-size: 20px;">
                      <button class="btn bg-blue-dark hover:bg-blue-darker text-white font-semibold uppercase p-2 rounded rounded-l-none tracking-wide text-sm px-4">Search</button>

                </form>



                <span class="text-grey-dark text-md font-semibold tracking-wide">{{ isset($threadgroup) ? $threadgroup : 'All Threads'}}</span>
                @foreach($discussions as $discussion)
                   @include('discussions._discussion')
                @endforeach

                <div class="mt-6">
                  {!! $discussions->links() !!}
                </div>
          </div>
      </div>
    </div>

     @include('discussions.new-modal')
@endsection