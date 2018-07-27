@extends('layouts.app')


@section('content')

        <div class="bg-grey-light" >
                 <div class="flex bg-white shadow container md:mx-auto" style="min-height: 800px;">

          @include('books._show-sidebar')
          <div class="w-3/4 p-6 pl-8">

               <span class="text-blue-dark text-sm font-semibold tracking-wide">
                <a href="/books" class="no-underline text-blue-dark hover:text-brand">
                 Books
                </a>
                <i class="fa fa-chevron-right text-grey-dark"></i>
                <a href="/books/{{ $subject->slug }}" class="no-underline text-blue-dark hover:text-brand">
                 {{ $subject->name }}
                </a>
                <i class="fa fa-chevron-right text-grey-dark"></i>  <span class="text-grey-darker">
                {{ $book->title }}</span>
              </span>

                <div class="flex items-start flex-col shadow-md rounded bg-white mt-8 p-4 border-4 border-brand border-l-0 border-b-0 border-r-0">

                    <h2>{{ $book->title }}</h2>

                    <div class="flex mt-3">
                    <img src="/img/author.png" class="mr-3" style="width: 22px;height: 100%;">
                      <p class="mt-1 font-semibold tracking-wide text-sm text-brand">{{ $book->author }}</p>
                     </div>

                    <p class="leading-normal tracking-wide text-lg mt-6">
                      {{ $book->description }}
                    </p>

                    <div class="flex mt-6">
                      <img src="/img/chapters.png" class="mr-3 mt-1" style="width: 22px;height: 100%;">
                      <p class="mt-2 font-semibold tracking-wide text-brand">{{ $book->chapters->count() }} Chapters</p>

                      <img src="/img/questions.png" class="mr-3 ml-8 mt-1" style="width: 25px;height: 100%;">
                      <p class="mt-2 font-semibold tracking-wide text-brand">{{ $book->questions->count() }} Questions</p>
                    </div>

                    @if(isset($startChapter))
                    <div>
                     @if($book->is_complete)
                     <a href="/books/{{$book->subject->slug}}/{{$book->slug}}/chapter:{{$startChapter->id}}" class="no-underline btn flex bg-orange hover:bg-orande-dark mt-8 text-white font-semibold uppercase p-3 rounded  tracking-wide text-sm px-8">
                           <i class="fa fa-check-circle mr-3"></i>  Completed
                         </a>
                         @elseif($book->is_ongoing)
                             <a href="/books/{{$book->subject->slug}}/{{$book->slug}}/chapter:{{$startChapter->id}}" class="no-underline btn flex bg-orange hover:bg-orande-dark mt-8 text-white font-semibold uppercase p-3 rounded  tracking-wide text-sm px-8">
                           <i class="fa fa-play mr-3"></i>  Continue
                         </a>
                         @else
                           <a href="/books/{{$book->subject->slug}}/{{$book->slug}}/chapter:{{$startChapter->id}}" class="no-underline btn flex bg-orange hover:bg-orande-dark mt-8 text-white font-semibold uppercase p-3 rounded  tracking-wide text-sm px-8">
                            Start Solving <i class="fa fa-arrow-right ml-3"></i>
                         </a>
                         @endif
                         </div>

                  </div>
                  @endif

          </div>
      </div>
        </div>

@endsection