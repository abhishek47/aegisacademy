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
                 <i class="fa fa-chevron-right text-grey-dark"></i>
                <a href="/books/{{ $subject->slug }}/{{$book->slug}}" class="no-underline text-blue-dark hover:text-brand">
                {{ $book->title }}
                </a>
                <i class="fa fa-chevron-right text-grey-dark"></i>  <span class="text-grey-darker">
                Chapter 1</span>
              </span>

                <div class="flex flex-col shadow-md rounded bg-white mt-8 p-4 border-4 border-brand border-l-0 border-b-0 border-r-0">


                <book-chapter problem-set="{{ $problem }}"></book-chapter>
            </div>

          </div>
      </div>
        </div>

@endsection