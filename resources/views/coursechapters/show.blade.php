@extends('layouts.app')


@section('content')

        <div class="bg-grey-light" >
                 <div class="flex bg-white shadow container md:mx-auto" style="min-height: 100vh;">

          @include('coursechapters._sidebar')
          <div class="w-3/4 p-6 pl-8">

               <span class="text-blue-dark text-sm font-semibold tracking-wide">
                <a href="/courses" class="no-underline text-blue-dark hover:text-brand">
                 Courses
                </a>
                <i class="fa fa-chevron-right text-grey-dark"></i>
                <a href="/courses/subject:{{ $course->subject->slug }}" class="no-underline text-blue-dark hover:text-brand">
                 {{ $course->subject->name }}
                </a>
                 <i class="fa fa-chevron-right text-grey-dark"></i>
                <a href="/courses/{{$course->slug}}" class="no-underline text-blue-dark hover:text-brand">
                {{ $course->title }}
                </a>
                <i class="fa fa-chevron-right text-grey-dark"></i>  <span class="text-grey-darker">
                {{ $chapter->title }}</span>
              </span>

                <div class="flex flex-col shadow-md rounded bg-white mt-8 p-4 border-4 border-brand border-l-0 border-b-0 border-r-0">
                   <div class="flex border border-grey-dark border-l-0 border-t-0 border-r-0 mb-3 pb-3">
                    <h3 class="flex-1 text-2xl font-semibold tracking-wide mt-1">{{ $section->title }}</h3>

                </div>
                  @if($section->content_type == 0)

                    <platex body="{{$section->body}}"></platex>

                  @elseif($section->content_type == 1)
                    <video
                      id="vid1"
                      class="video-js vjs-default-skin mx-auto"

                      controls
                      width="640" height="364"
                      data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "{{ $section->video->url }}"}] }'
                    >
                    </video>

                  @elseif($section->content_type == 2)

                     <book-chapter problem-set="{{ $section->problem }}"></book-chapter>

                  @endif



            </div>

          </div>
      </div>
        </div>

@endsection