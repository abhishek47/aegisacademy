@extends('layouts.app')


@section('content')

        <div class="bg-grey-light" >
                 <div class="flex bg-white shadow container md:mx-auto" style="min-height: 100vh;">

        {{--   @include('books._sidebar') --}}
          <div class="w-100 p-6 pl-8">


                <form class="flex w-full mx-auto bg-white shadow-md rounded border-2 border-grey mb-6">

                      <i class="fa fa-search text-xl ml-3" style="color: #8795a185;margin-top: 10px;"></i>
                      <input type="text" class="w-full  p-2 pt-1 mt-1 text-grey-dark" value="{{ request('query') }}" autocomplete="off" placeholder="Type something..." name="query" style="font-size: 20px;">
                      <button class="btn bg-blue-dark hover:bg-blue-darker text-white font-semibold uppercase p-2 rounded rounded-l-none tracking-wide text-sm px-4">Search</button>

                </form>



                <span class="text-grey-dark text-lg font-semibold tracking-wide">{!! isset($bookgroup) ? $bookgroup : 'All Books'!!}</span>

                <div class="mt-1 mb-4">

                     <div class="flex">
                         @foreach($books as $book)
                         <div class="w-1/2 pr-3">
                           <div class="flex items-start flex-col shadow-md rounded bg-white mt-8 p-4 relative
                           {{ $book->is_blocked ? 'border-2 border-red pointer-events-none' : 'border-t-4 border-brand'}} ">

                            @if($book->is_blocked)
                               <span class="rounded rounded-full p-2 bg-red text-white absolute" style="left: -10px;top: -10px;"><i class="fa fa-lock"> </i></span>
                             @endif
                    <h2 class="text-lg">{{ str_limit($book->title, 33) }}</h2>

                    <div class="flex mt-3">
                    <img src="/img/author.png" class="mr-3" style="width: 22px;height: 100%;">
                      <p class="mt-1 font-semibold tracking-wide text-sm text-brand">{{ $book->author }}</p>
                     </div>



                    <div class="flex mt-4">
                      <img src="/img/chapters.png" class="mr-3 mt-1" style="width: 22px;height: 100%;">
                      <p class="mt-2 font-semibold tracking-wide text-brand">{{ $book->chapters->count() }} Chapters</p>

                      <img src="/img/questions.png" class="mr-3 ml-8 mt-1" style="width: 25px;height: 100%;">
                      <p class="mt-2 font-semibold tracking-wide text-brand">{{ $book->questions->count() }} Questions</p>
                    </div>


                    <div>

                       @if($book->is_complete)
                     <a href="/books/{{$book->subject->slug}}/{{$book->slug}}/" class="no-underline btn flex bg-orange hover:bg-orande-dark mt-6 text-white font-semibold  p-2 rounded  tracking-wide text-sm px-4">
                            <i class="fa fa-check-circle mr-2" style="margin-top: 1px;"></i> Completed
                         </a>
                         @elseif($book->is_ongoing)

                            <a href="/books/{{$book->subject->slug}}/{{$book->slug}}/" class="no-underline btn flex bg-orange hover:bg-orande-dark mt-6 text-white font-semibold  p-2 rounded  tracking-wide text-sm px-4">
                            <i class="fa fa-play mr-2" style="margin-top: 1px;"></i> Continue
                         </a>

                         @else
                           <a href="/books/{{$book->subject->slug}}/{{$book->slug}}/" class="no-underline btn flex bg-orange hover:bg-orande-dark mt-6 text-white font-semibold  p-2 rounded  tracking-wide text-sm px-4">
                           Start Solving <i class="fa fa-arrow-right ml-2" style="margin-top: 1px;"></i>
                         </a>

                         @endif
                         </div>

                  </div>
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