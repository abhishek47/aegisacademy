@extends('layouts.app')
@section('content')


<div class="bg-grey-lighter flex" style="min-height: 100vh;">
    <div class="container md:mx-auto mt-8">
        {{--   <div class="flex flex-col shadow-md rounded bg-white p-4 border-4 border-brand border-l-0 border-b-0 border-r-0">
            <div class="flex border border-grey-dark border-l-0 border-t-0 border-r-0 pb-3">
                <h3 class="flex-1 text-2xl font-semibold tracking-wide mt-1 ml-2">Problems of the week</h3>
                <select class="border-2 border-brand p-2 rounded text-brand font-semibold tracking-wide text-md">
                    <option>1st Week of November</option>
                    <option>1st Week of November</option>
                    <option>1st Week of November</option>
                    <option>1st Week of November</option>
                </select>
            </div>
        <practice-problems problem-set="{{ $problem }}"></practice-problems>
    </div>
    --}}
    <h2 class="text-grey-darkest text-2xl my-4">Latest Wiki Pages</h2>
    <div class="container mx-auto flex mt-8" style="flex-wrap: wrap;">
        @foreach($wikis as $index => $article)
         <a href="{{ url($article->url)}}" class="no-underline text-black w-1/2 pr-6 mb-8">
                                        <div class="rounded shadow-md bg-white p-6 pt-4 border-t-4 border-b-0 border-r-0 border-l-0 border-brand  course-card">

                                            <div class="flex items-center justify-between">
                                                <span class="rounded p-1 px-4 text-white tracking-wide text-xs" style="background-color: {{ $article->category->color->code }}">{{ $article->category->name }}</span>

                                                <rate-wiki id="{{$article->id}}" :edit="false" user-rating="{{$article->rating}}" size="20"></rate-wiki>

                                            </div>

                                            <h3 class="w-full text-xl font-normal tracking-normal leading-normal mt-4 mb-4">
                                                <i class="fa fa-check-circle text-green" v-show="{{ auth()->user()->hasRead($article) }}"></i>  {{ str_limit($article->title, 30) }}
                                            </h3>
                                            <div class="flex justify-between">

                                           {{--  <div class="flex mt-1">
                                                <img class="mr-2" src="/img/studentsicon.png" style="width: 25px;height:100%;">
                                                <span class="text-blue mt-1"> {{$article->readings}} people read this.</span>
                                            </div> --}}

                                         {{--     <span class="text-grey-darker mt-2"><i class="fa fa-clock"></i> {{ $article->created_at->format('jS M Y')}}</span> --}}
                                            </div> 
                                        </div>
                                    </a>
        @endforeach

          <div class="flex justify-center mb-8 mx-w-md" style="margin: auto;">
            <a href="{{ url('/wiki') }}" class="no-underline self-center  bg-transparent hover:bg-brand text-brand-dark font-semibold hover:text-white py-3 px-45 border border-brand hover:border-transparent rounded mr-6">
                  View More
                </a>
        </div>
    </div>


    @if(false)
    <h2 class="text-grey-darkest text-2xl my-4">Recent Practice Problems</h2>
    <div class="container mx-auto mt-8 mb-8" style="flex-wrap: wrap;">
        @foreach($problems as $index => $problem)
         <div href="" class="flex flex-col rounded bg-white shadow-md p-3 pt-4 border-4 border-brand border-l-0 border-b-0 border-r-0 mb-2">

                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-black font-semibold tracking-wide text-2xl">{{ $problem->title }}</h2>
                                    <p class="text-grey-dark tracking-wide leading-normal mt-3">{{ $problem->description }}</p>
                                </div>


                                    @if($problem->is_complete)
                                        <a href="/practice/{{$problem->subject->slug}}/topic:{{$problem->topic->id}}/problem:{{$problem->slug}}" class="no-underline btn flex bg-orange hover:bg-orande-dark ml-8 mr-4 mt-2 text-white font-semibold uppercase p-3 rounded  tracking-wide text-sm px-8">
                                           <i class="fa fa-check-circle mr-3"></i>  Completed
                                         </a>

                                    @elseif($problem->is_ongoing)
                                            <a href="/practice/{{$problem->subject->slug}}/topic:{{$problem->topic->id}}/problem:{{$problem->slug}}" class="no-underline btn flex bg-blue hover:bg-blue-dark ml-8 mr-4 mt-2 text-white font-semibold uppercase p-3 rounded  tracking-wide text-sm px-8">
                                           <i class="fa fa-play mr-3"></i> Continue
                                          </a>
                                    @else
                                        <a href="/practice/{{$problem->subject->slug}}/topic:{{$problem->topic->id}}/problem:{{$problem->problem->slug}}"  class="no-underline btn flex bg-green hover:bg-green-dark ml-8 mr-4 mt-2 text-white font-semibold uppercase p-3 rounded  tracking-wide text-sm px-8">
                                       <i class="fa fa-play mr-3"></i>  Start
                                     </a>
                                    @endif

                            </div>


                            <div class="flex justify-between mt-4">
                                <div class="flex mt-1">
                                      <img class="mr-2 " src="/img/level.png" style="width: 25px;height:100%;">
                                    <span class="text-blue mt-1 tracking-wide"> {{$problem->level }}</span>

                                    <img class="mr-2 ml-6" src="/img/questions.png" style="width: 25px;height:100%;">
                                    <span class="text-blue mt-1"> {{$problem->questions->count()}} questions</span>


                                </div>

                                 <span class="text-grey-darker mt-2"><i class="fa fa-clock"></i> {{ $problem->created_at->format('jS M Y')}}</span>
                            </div>
                        </div>
        @endforeach
    </div>
    @endif

    @if(count($books) > 0)
    <h2 class="text-grey-darkest text-2xl my-8">Currently Solving Books</h2>
    <div class="container mx-auto mt-8 mb-8" style="flex-wrap: wrap;">
    @foreach($books as $book)
                         <div class="w-1/3 pr-3  rescrd">
                           <div class="flex items-start flex-col shadow-md rounded bg-white mt-8 p-4 border-4 border-brand border-l-0 border-b-0 border-r-0">

                    <h2 class="text-lg">{{ str_limit($book->title, 33) }}</h2>

                    <div class="flex mt-3">
                    <img src="/img/author.png" class="mr-3 booksimg" style="width: 22px;height: 100%;">
                      <p class="mt-1 font-semibold tracking-wide text-sm text-brand">{{ $book->author }}</p>
                     </div>



                    <div class="flex mt-4">
                      <img src="/img/chapters.png" class="mr-3 booksimg mt-1" style="width: 22px;height: 100%;">
                      <p class="mt-2 font-semibold tracking-wide text-brand">{{ $book->chapters->count() }} Chapters</p>

                      <img src="/img/questions.png" class="mr-3 booksimg ml-8 mt-1" style="width: 25px;height: 100%;">
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
                      @endif

                      @if(count($courses) > 0)
                      <h2 class="text-grey-darkest text-2xl my-4">Ongoing Courses</h2>

                      <div class="flex flex-wrap mt-8 mb-8">
                             @foreach($courses as $course)

                                <a href="/courses/{{$course->slug}}" class="bg-white shadow-md mr-1 rounded p-2 no-underline" style="background: {{$course->color->code}};height: 320px;width: 227px;">
                                    <h4 class="text-xl font-semibold text-white tracking-wide leading-normal pl-2">{{ str_limit($course->title, 20) }}</h4>

                                    <div class="w-100">
                                    <img src="{{ url($course->banner) }}" class="mx-auto block mt-4" style="width: 145px;height: 145px;">
                                    </div>

                                    <p class="text-white tracking-wide leading-normal p-2 text-sm mt-2">{{ str_limit($course->description, 50) }}</p>
                                </a>

                             @endforeach

                         </div>

                        @endif
</div>
</div>
@endsection