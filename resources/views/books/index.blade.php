@extends('layouts.app')


@section('content')

        <div class="bg-grey-light" >
                 <div class="flex bg-white shadow container md:mx-auto" style="min-height: 800px;">

          @include('books._sidebar')
          <div class="w-3/4 p-6 pl-8">


                <form class="flex w-full mx-auto bg-white shadow-md rounded border-2 border-grey mb-6">

                      <i class="fa fa-search text-xl ml-3" style="color: #8795a185;margin-top: 10px;"></i>
                      <input type="text" class="w-full  p-2 pt-1 mt-1 text-grey-dark" value="{{ request('query') }}" autocomplete="off" placeholder="Type something..." name="query" style="font-size: 20px;">
                      <button class="btn bg-blue-dark hover:bg-blue-darker text-white font-semibold uppercase p-2 rounded rounded-l-none tracking-wide text-sm px-4">Search</button>

                </form>



                <span class="text-grey-dark text-lg font-semibold tracking-wide">{!! isset($bookgroup) ? $bookgroup : 'All Books'!!}</span>

                <div class="mt-8">

                     <div class="flex flex-wrap">
                         @foreach($books as $book)
                          <div class="w-1/3 mr-2">
                            <a href="/books/{{$book->subject->slug}}/{{$book->slug}}" class="no-underline w-full flex flex-col rounded bg-white shadow-md text-black">
                                <img src="{{ isset($book->image) ? url($book->image) : '/img/poster.jpg' }}" class="w-full" style="height: 220px">
                                <div class="mt-0 p-2">
                                     <h2 class="text-lg leading-normal tracking-wide">
                                        {{ $book->title }}
                                     </h2>
                                </div>

                            </a>
                          </div>
                         @endforeach
                     </div>

                </div>

                <div class="mt-6 mb-8">
                    {!! $books->links() !!}
                </div>
          </div>
      </div>
        </div>

@endsection