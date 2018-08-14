@extends('layouts.app')

@section('content')


    <div class="bg-grey-lightest" >
      <div class="flex bg-white shadow container md:mx-auto" style="min-height: 800px;">

          <div class="bg-blue-lightest p-4 " style="min-height: 800px;background: {{ $course->color->code }};max-width: 400px;">
              <div class="flex flex-col p-4">

                 <div class="w-100">
                                    <img src="{{ url($course->banner) }}" class="block mt-4 mb-4" style="width: 145px;height: 145px;">
                                    </div>

                  <h2 class="mt-6 text-white mt-4 text-left  text-2xl font-bold tracking-wide leading-normal">{{ $course->title }}</h2>

                  <p class="text-white mt-3 tracking-wide text-left leading-normal">
                    {{ $course->description }}
                  </p>


                   <ul class="mt-4 list-reset">
                     <li class="my-8 text-white text-lg flex font-normal tracking-wide">
                        <img class="mr-2 " src="/img/list.png" style="width: 30px;height:100%;"> <span class="mt-1 ml-2">{{ $course->chapters()->count() }} Chapters</span>
                      </li>
                      <li class="my-8 text-white text-lg flex font-normal tracking-wide">
                        <img class="mr-2 " src="/img/ques.png" style="width: 30px;height:100%;"> <span class="mt-1 ml-2">2 Quizzes</span>
                      </li>
                   </ul>


              </div>
          </div>
          <div class="w-3/4 p-6 pl-8">

             <span class="text-blue-dark text-sm font-semibold tracking-wide">
                <a href="/courses" class="no-underline text-blue-dark hover:text-brand">
                 All Courses
                </a>

                 <i class="fa fa-chevron-right text-grey-dark"></i>  <span class="text-grey-darker">
                 <a href="/courses/subject:{{$course->subject->slug}}" class="no-underline text-blue-dark hover:text-brand">
                 {{ $course->subject->name }}
                </a></span>

                <i class="fa fa-chevron-right text-grey-dark"></i>  <span class="text-grey-darker">
                {{ $course->title }}</span>
              </span>




                    <div class="flex flex-col mb-4 mt-6">

                         <div class="flex flex-col w-100">

                              @foreach($course->chapters as $chapter)
                                  <a href="#" class="bg-white shadow-md p-3 flex rounded no-underline text-black hover:bg-grey-lightest mb-4" style="width: 100%;">
                                      <img src="{{ url($chapter->banner) }}" style="width: 80px;height: 80px;">

                                      <div class="flex flex-col ml-4 w-100 mt-4">
                                        <h3 class="font-semibold tracking-wide text-xl mb-2">{{ $chapter->title }}</h3>
                                        <p class="tracking-wide text-grey-dark text-lg">{{ $chapter->description }}</p>
                                      </div>
                                  </a>
                              @endforeach

                         </div>
                    </div>

                    <div class="mt-6 mb-8">
                    </div>



          </div>

       </div>
    </div>


@endsection