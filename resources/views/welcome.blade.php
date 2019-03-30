@extends('layouts.app')


@section('content')

    <div class="container mx-auto mt-8 mb-8">
        <div class="w-3/4 mx-auto flex flex-col items-stretch">
            <h2 class="text-4xl text-center text-brand mt-6 mb-8 tracking-wide leading-normal capitalize font-normal">
                If you love <b class="font-bold">challenging</b> problems then you are at the right place!
            </h2>
            <div class="flex-1 mt-6">
                <form method="GET" action="/wiki">
                <div class="flex w-3/5 mx-auto bg-white shadow-md rounded border-2 border-grey">

                    <i class="fa fa-search text-xl mt-4 ml-3" style="color: #8795a185;margin-top: 21px;"></i>
                    <input type="text" class="search-input w-full p-4 mt-1 text-grey-dark" autocomplete="off" placeholder="What will you learn?" name="query" style="font-size: 20px;">
                    <button class="btn bg-brand text-white font-semibold uppercase p-2 rounded rounded-l-none tracking-wide text-sm px-4">Search</button>

                </div>
                 </form>

            </div>

            <div class="flex items-center mt-8 pt-8 justify-center">
                 <a href="{{ url('/login') }}" class="no-underline  bg-orange hover:bg-orange-dark text-white font-semibold hover:text-white py-3 px-6 border hover:border-transparent rounded mr-4">
                              Begin Learning
                </a>
                 <a href="{{ url('/register') }}" class="no-underline bg-transparent hover:bg-brand text-brand-dark font-semibold hover:text-white py-3 px-6 border border-brand hover:border-transparent rounded">
                  Discussions
                </a>
            </div>

            <div class="mt-8 pt-3">
                <img class="mt-8 pt-6" src="{{ asset('img/banner-home.png') }}" style="width: 100%;">
            </div>


        </div>
    </div>


    <div class="bg-grey-lightest py-60">

        <div class="mb-60">
              <h2 class="text-4xl text-center text-brand mb-8 tracking-wide leading-normal capitalize font-semibold">
                Wiki Articles &ndash; Learn with reading
            </h2>
        </div>

        <div class="container mx-auto flex mt-8" style="flex-wrap: wrap;">
            @foreach($wikis as $article)
                 <a href="{{ url($article->url)}}" class="no-underline text-black w-1/2 pr-6 mb-8">
                                        <div class="rounded shadow-md bg-white p-6 pt-4 border-t-4 border-b-0 border-r-0 border-l-0 border-brand">

                                            <div class="flex items-center justify-between">
                                                <span class="rounded p-1 px-4 text-white tracking-wide text-xs" style="background-color: {{ $article->category->color->code }}">{{ $article->category->name }}</span>

                                                <rate-wiki id="{{$article->id}}" :edit="false" user-rating="{{$article->rating}}" size="20"></rate-wiki>

                                            </div>

                                            <h3 class="w-full text-xl font-normal tracking-normal leading-normal mt-4 mb-4">
                                                {{ str_limit($article->title, 30) }}
                                            </h3>
                                            <div class="flex justify-between">

                                            <div class="flex mt-1">
                                                <img class="mr-2" src="/img/studentsicon.png" style="width: 25px;height:100%;">
                                                <span class="text-blue mt-1"> {{$article->readings}} people read this.</span>
                                            </div>

                                             <span class="text-grey-darker mt-2"><i class="fa fa-clock"></i> {{ $article->created_at->format('jS M Y')}}</span>
                                            </div>
                                        </div>
                                    </a>
            @endforeach


        </div>

        <div class="flex justify-center mt-8 mx-w-md">
            <a href="{{ url('/wiki') }}" class="no-underline bg-transparent hover:bg-brand text-brand-dark font-semibold hover:text-white py-3 px-45 border border-brand hover:border-transparent rounded mr-6">
                  View More
                </a>
        </div>
    </div>


    <div class="bg-white py-60">
        <div class="container mx-auto flex mt-8 mb-8">
            <div class="w-3/5">
                 <h2 class="text-4xl text-left text-brand mb-8 tracking-wide leading-normal capitalize font-normal">
                    Teach yourelf with <b class="font-semibold">Self-paced</b> courses
                </h2>

                <p class="text-black text-xl tracking-wide leading-normal mb-3">
                    Best way to learn is self education. In self-paced courses we provide step wise curated content to learn
                    a specific topic with thorough understanding. This content can contain small wiki articles, videos as well as practice problems
                    to perfect yourself as you learn.
                </p>

                <div class="flex items-center mt-8 pt-8 justify-start">
                 <a href="{{ url('/login') }}" class="no-underline  bg-orange hover:bg-orange-dark text-white font-semibold hover:text-white py-3 px-6 border hover:border-transparent rounded mr-4">
                              Sign Up Now
                </a>
                 <a href="{{ url('/register') }}" class="no-underline bg-transparent hover:bg-brand text-brand-dark font-semibold hover:text-white py-3 px-6 border border-brand hover:border-transparent rounded">
                  Explore Courses
                </a>
            </div>


            </div>

            <div class="w-2/5 pl-60 -mb-8">
                <img style="width: 350px;" src="{{ asset('img/courses.png') }}">
            </div>
        </div>
    </div>


     <div class="bg-white py-60 pt-30">
        <div class="container mx-auto flex mb-8">
            <div class="w-2/5 pr-60 -mb-40">
                <img style="width: 300px;" src="{{ asset('img/practice.png') }}">
            </div>

             <div class="w-3/5">
                 <h2 class="text-4xl text-left text-brand mb-8 tracking-wide leading-normal capitalize font-normal">
                    Get Perfection by solving <b class="font-semibold">Practice</b> problems
                </h2>

                <p class="text-black text-xl tracking-wide leading-normal mb-3">
                    Practice makes man perfect. Hence, we provide a huge range of practice problems categorised under different
                    subjects and topics for you to practice the right thing. Keep a track of what you solve, discuss solutions with experts and other
                    students.
                </p>




            </div>


        </div>
    </div>

    <div class="bg-teal bg-cover bg-no-repeat py-60" style="background: #F5E2C8;">
        <div class="">
            <div class="container mx-auto flex flex-col mt-8 mb-45 items-left">
                <h2 class="text-4xl text-left text-brand mb-8 tracking-wide leading-normal capitalize font-normal">
                    Learn and disuss with your fellow mates and our teaching experts on our <b class="font-semibold">forums</b>.
                </h2>

                <p class="w-full text-black text-xl text-left tracking-wide leading-normal">
                    Learning is always about discussing and sharing things you know. We provide a curated and equipped discussion forum for
                    you to discuss your concerns with our experts as well as other students. Ask questions, use your knowledge to answer some questions or just find out the
                    proper discussion to solve your concerns.

                </p>

                <div class="mt-45 ">
                <a href="{{ url('/login') }}" class="no-underline bg-teal hover:bg-teal-dark text-white tracking-wide uppercase font-semibold hover:text-white py-3 px-8 border hover:border-transparent rounded mr-4">
                              Join Our Community
                </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-60">
        <div class="container mx-auto flex flex-col mt-8 mb-45">

            <div class="mb-60">
              <h2 class="text-4xl text-center text-brand mb-8 tracking-wide leading-normal capitalize font-semibold">
                A Simple Pricing Model
              </h2>
            </div>

            <div class="flex justify-between">
                <div class="bg-white shadow-md rounded w-full md:w-1/2 z-10 mr-6 border-t-4  border-brand">
                    <div class="py-8 text-3xl text-center text-brand font-semibold uppercase">FREE</div>
                    <hr class="py-0 my-0 border border-grey-lighter">
                    <div class="py-8">

                        <ul class="list-reset text-center">
                            <li class="my-3 text-xl">Read Unlimited Wiki Pages</li>
                            <li class="my-3 text-xl">Access 12 problem solutions of TOMATO.</li>
                            <li class="my-3 text-xl">Access first chapter of all courses.</li>
                        </ul>


                    </div>
                    <a href="#" class="no-underline">
                        <div class="py-8 bg-grey-lighter hover:bg-grey-light text-indigo-darker rounded rounded-t-none text-center uppercase font-bold flex items-center justify-center">
                            <span>Begin Learning</span>
                            <i class="ml-2 fa fa-arrow-right"></i>
                        </div>
                    </a>
                </div>

                <div class="bg-white shadow-md rounded w-full md:w-1/2 z-10 border-t-4  border-brand">
                    <div class="py-8 text-3xl text-center text-orange font-semibold uppercase"><span class="capitalize"></span> <s style="color: grey;font-size: 22px;">₹ 3000</s> ₹ 1500 / year</div>
                    <hr class="py-0 my-0 border border-grey-lighter">
                    <div class="py-8">

                         <ul class="list-reset text-center">
                            <li class="my-3 text-xl">Read Unlimited Wiki Pages</li>
                            <li class="my-3 text-xl">Access complete solution of TOMATO.</li>
                            <li class="my-3 text-xl">Access all courses fully.</li>
                        </ul>


                    </div>
                    <a href="/register" class="no-underline">
                        <div class="py-8 bg-grey-lighter hover:bg-grey-light text-indigo-darker rounded rounded-t-none text-center uppercase font-bold flex items-center justify-center">
                            <span>Create account</span>
                            <i class="ml-2 fa fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>


@endsection

