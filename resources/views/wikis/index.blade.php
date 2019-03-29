@extends('layouts.app')

@section('content')
    <div class="bg-grey-lightest">
      <div class="flex bg-white shadow container md:mx-auto" style="min-height: 100vh;">

          @include('wikis._sidebar')
          <div class="w-3/4 p-6 pl-8">


                <form class="flex w-full mx-auto bg-white shadow-md rounded border-2 border-grey mb-6">

                      <i class="fa fa-search text-xl ml-3" style="color: #8795a185;margin-top: 10px;"></i>
                      <input type="text" class="w-full  p-2 pt-1 mt-1 text-grey-dark" value="{{ request('query') }}" autocomplete="off" placeholder="Type something..." name="query" style="font-size: 20px;">
                      <button class="btn bg-blue-dark hover:bg-blue-darker text-white font-semibold uppercase p-2 rounded rounded-l-none tracking-wide text-sm px-4">Search</button>

                </form>



                <span class="text-grey-dark text-lg font-semibold tracking-wide">{!! isset($wikigroup) ? $wikigroup : 'All Problems'!!}</span>

                <div class="mt-8">

                        <?php $articleChunks = $articles->chunk(2); ?>

                        @foreach($articleChunks as $articlesList)

                            <div class="flex">
                                @foreach($articlesList as $article)

                                     <a href="{{ url($article->url)}}" class="no-underline text-black w-1/2 pr-6 mb-8">
                                        <div class="rounded shadow-md bg-white p-6 pt-4 border-t-4 border-b-0 border-r-0 border-l-0 border-brand">

                                            <div class="flex items-center justify-between">
                                                <span class="rounded p-1 px-4 text-white tracking-wide text-xs" style="background-color: {{ $article->category->color->code }}">{{ $article->category->name }}</span>

                                                <rate-wiki id="{{$article->id}}" :edit="false" user-rating="{{$article->rating}}" size="20"></rate-wiki>

                                            </div>

                                            <h3 class="w-full text-xl font-normal tracking-normal leading-normal mt-4 mb-4">
                                                <i class="fa fa-check-circle text-green" v-show="{{ auth()->user()->hasRead($article) }}"></i>  {{ str_limit($article->title, 30) }}
                                            </h3>
                                            <div class="flex justify-between">

                                            {{-- <div class="flex mt-1">
                                                <img class="mr-2" src="/img/studentsicon.png" style="width: 25px;height:100%;">
                                                <span class="text-blue mt-1"> {{$article->readings}} people read this.</span>
                                            </div>

                                             <span class="text-grey-darker mt-2"><i class="fa fa-clock"></i> {{ $article->created_at->format('jS M Y')}}</span>
                                            </div>  --}}
                                        </div>
                                    </a>


                                @endforeach
                            </div>

                        @endforeach
                </div>

                <div class="mt-6 mb-8">
                    {!! $articles->links() !!}
                </div>
          </div>
      </div>
    </div>

     @include('discussions.new-modal')
@endsection