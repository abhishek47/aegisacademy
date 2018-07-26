@extends('layouts.app')

@section('content')
    <div class="bg-grey-lightest">
      <div class="flex bg-white shadow container md:mx-auto" style="min-height: 800px;">

          @include('practice._sidebar')
          <div class="w-3/4 p-6 pl-8">


                <form class="flex w-full mx-auto bg-white shadow-md rounded border-2 border-grey mb-6">

                      <i class="fa fa-search text-xl ml-3" style="color: #8795a185;margin-top: 10px;"></i>
                      <input type="text" class="w-full p-2 pt-1 mt-1 text-grey-dark" value="{{ request('query') }}" autocomplete="off" placeholder="Type something..." name="query" style="font-size: 20px;">
                      <button class="btn bg-blue-dark hover:bg-blue-darker text-white font-semibold uppercase p-2 rounded rounded-l-none tracking-wide text-sm px-4">Search</button>

                </form>



                <span class="text-grey-dark text-lg font-semibold tracking-wide">{!! isset($topicgroup) ? $topicgroup : 'All Problems'!!}</span>

                <div class="mt-8">
                    @foreach($problems as $problem)
                        <div href="" class="flex flex-col rounded bg-white shadow-md p-3 pt-4 border-4 border-brand border-l-0 border-b-0 border-r-0">

                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-black font-semibold tracking-wide text-2xl">{{ $problem->title }}</h2>
                                    <p class="text-grey-dark tracking-wide leading-normal mt-3">{{ $problem->description }}</p>
                                </div>


                                    @if($problem->is_complete)
                                        <a href="/practice/{{$subject->slug}}/topic:{{$topic->id}}/problem:{{$problem->slug}}" class="no-underline btn flex bg-orange hover:bg-orande-dark ml-8 mr-4 mt-2 text-white font-semibold uppercase p-3 rounded  tracking-wide text-sm px-8">
                                           <i class="fa fa-check-circle mr-3"></i>  Completed
                                         </a>

                                    @elseif($problem->is_ongoing)
                                            <a href="/practice/{{$subject->slug}}/topic:{{$topic->id}}/problem:{{$problem->slug}}" class="no-underline btn flex bg-blue hover:bg-blue-dark ml-8 mr-4 mt-2 text-white font-semibold uppercase p-3 rounded  tracking-wide text-sm px-8">
                                           <i class="fa fa-play mr-3"></i> Continue
                                          </a>
                                    @else
                                        <a href="/practice/{{$subject->slug}}/topic:{{$topic->id}}/problem:{{$problem->slug}}"  class="no-underline btn flex bg-green hover:bg-green-dark ml-8 mr-4 mt-2 text-white font-semibold uppercase p-3 rounded  tracking-wide text-sm px-8">
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

                <div class="mt-6">
                    {!! $problems->links() !!}
                </div>
          </div>
      </div>
    </div>

     @include('discussions.new-modal')
@endsection