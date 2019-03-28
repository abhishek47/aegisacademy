@extends('layouts.app')

@section('content')


    <div class="bg-grey-lightest" >
      <div class="flex bg-white shadow container md:mx-auto" style="min-height: 100vh;">

          @include('courses._sidebar')
          <div class="w-3/4 p-6 pl-8">

               <a href="javascript:;" @click.prevent="showSidebar = !showSidebar" class="text-grey-dark no-underline mb-4 font-semibold block"><i class="fa fa-bars"></i> Toggle Sidebar</a>

                <form class="flex w-full mx-auto bg-white shadow-md rounded border-2 border-grey mb-6">

                      <i class="fa fa-search text-xl ml-3" style="color: #8795a185;margin-top: 10px;"></i>
                      <input type="text" class="w-full  p-2 pt-1 mt-1 text-grey-dark" value="{{ request('query') }}" autocomplete="off" placeholder="Type something..." name="query" style="font-size: 20px;">
                      <button class="btn bg-blue-dark hover:bg-blue-darker text-white font-semibold uppercase p-2 rounded rounded-l-none tracking-wide text-sm px-4">Search</button>

                </form>

                <span class="text-grey-dark text-lg font-semibold tracking-wide">{!! isset($coursegroup) ? $coursegroup : 'All Courses'!!}</span>

                    <div class="flex flex-col mb-4 mt-4">

                         <div class="flex">
                             @foreach($courses as $course)

                                <a href="/courses/{{$course->slug}}" class="bg-white shadow-md mr-1 relative rounded p-2 no-underline {{ $course->is_blocked ? 'border-2 border-red pointer-events-none' : ($course->completed ? 'border-2 border-green' : '') }}" style="background: {{$course->color->code}};height: 320px;">

                                    @if($course->is_blocked)
                                     <span class="rounded rounded-full p-2 bg-red text-white absolute" style="right: -10px;top: -10px;"><i class="fa fa-lock"> </i></span>
                                     @else
                                      @if($course->completed)
                                      <span class="rounded rounded-full p-2 bg-green text-white absolute" style="right: -10px;top: -10px;"><i class="fa fa-check"> </i></span>
                                      @endif
                                    @endif
                                    <h4 class="text-xl font-semibold text-white tracking-wide leading-normal pl-2">{{ str_limit($course->title, 20) }}</h4>

                                    <div class="w-100">
                                    <img src="{{ url($course->banner) }}" class="mx-auto block mt-4" style="width: 145px;height: 145px;">
                                    </div>

                                    <p class="text-white tracking-wide leading-normal p-2 text-sm mt-2">{{ str_limit($course->description, 50) }}</p>
                                </a>

                             @endforeach

                         </div>
                    </div>

                    <div class="mt-6 mb-8">
                       {!! $courses->links() !!}
                    </div>



          </div>

       </div>
    </div>


@endsection