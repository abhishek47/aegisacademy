@extends('layouts.app')

@section('content')



    <div class="bg-grey-lightest">

      <div class="flex bg-white shadow container md:mx-auto" style="min-height: 800px;">
        <div class="bg-blue-lightest p-4 pr-55" style="min-height: 800px;">
            <div class="flex flex-col p-4 pl-0 pr-6 mx-3">
                <button @click="showModal('new-thread')" class="shadow bg-green hover:bg-green-dark rounded text-white p-3 px-6 font-semibold tracking-wide">
                    Add New Thread
                </button>

                <span class="mt-6 text-grey-darker uppercase text-sm font-bold tracking-wide">Browse</span>

                <ul class="mt-2 list-reset">
                    <li class="mt-2 text-md">
                        <a href="" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark">
                             <i class="fa fa-comments mr-1"></i> All Threads
                        </a>
                    </li>

                    <li class="mt-3 text-md">
                        <a href="" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark">
                             <i class="fa fa-user mr-2"></i> My Threads
                        </a>
                    </li>

                    <li class="mt-3 text-md">
                        <a href="" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark">
                             <i class="fa fa-star mr-1"></i> Popular Threads
                        </a>
                    </li>

                    <li class="mt-3 text-md">
                        <a href="" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark">
                             <i class="fas fa-question-circle mr-1"></i> Unanswered Threads
                        </a>
                    </li>
                </ul>
             </div>


         </div>

          <div class="w-3/4 p-6 pl-8">
                <span class="text-grey-dark text-md font-semibold tracking-wide">All Threads</span>

                <div class="flex mt-8  pb-8 border-t-0 border-x-0 border-b border-grey-light">
                    <img class="rounded-full" src="/img/user.png" style="width: 45px;height: 45px;">

                    <div class="flex flex-col ml-4">
                        <a href="/discussions/show" class="no-underline">
                            <h4 class="text-xl text-blue-dark font-semibold">
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                             </h4>
                         </a>
                         <span class="text-sm mt-2 text-black font-semibold">
                             Posted by :
                             <a class="no-underline text-blue" href="#">Abhishek Wani</a>
                         </span>

                         <div class="mt-4 text-lg text-black leading-normal">
                             Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                             quis nostrud exercitation ullamco laboris nisi.
                         </div>

                         <div class="mt-6 flex justify-between">
                            <div class="flex">
                                <span class="bg-grey-light mr-8 rounded text-md font-semibold text-grey-darker p-2">
                                    <i class="fa fa-circle text-red text-xs mr-2"></i> Olympiads
                                </span>

                                <span class="text-md font-semibold mr-6 text-grey-dark pt-2">
                                     <i class="fa fa-eye  mr-1"></i> 3 Visits
                                </span>

                                <span class="text-md font-semibold mr-6 text-grey-dark pt-2">
                                     <i class="fa fa-comments  mr-1"></i> 3 Replies
                                </span>
                            </div>

                            <button class="border  bg-white text-grey-dark -mt-1 p-1 px-3 text-sm font-semibold rounded">
                                read more
                            </button>

                         </div>
                    </div>
                </div>

                 <div class="flex mt-8 pb-8 border-t-0 border-x-0 border-b border-grey-light">
                    <img class="rounded-full" src="/img/user.png" style="width: 45px;height: 45px;">

                    <div class="flex flex-col ml-4">
                        <a href="/discussions/show" class="no-underline">
                            <h4 class="text-xl text-blue-dark font-semibold">
                              Incididunt ut labore et dolore magna
                             </h4>
                         </a>
                         <span class="text-sm mt-2 text-black font-semibold">
                             Posted by :
                             <a class="no-underline text-blue" href="#">Jhon Doe</a>
                         </span>

                         <div class="mt-4 text-lg text-black leading-normal">
                             Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                             quis nostrud exercitation ullamco laboris nisi.
                         </div>

                         <div class="mt-6 flex justify-between">
                            <div class="flex">
                                <span class="bg-grey-light mr-8 rounded text-md font-semibold text-grey-darker p-2">
                                    <i class="fa fa-circle text-green text-xs mr-2"></i> NEET
                                </span>

                                <span class="text-md font-semibold mr-6 text-grey-dark pt-2">
                                     <i class="fa fa-eye  mr-1"></i> 1 Visits
                                </span>

                                <span class="text-md font-semibold mr-6 text-grey-dark pt-2">
                                     <i class="fa fa-comments  mr-1"></i> 0 Replies
                                </span>
                            </div>

                            <button class="border  bg-white text-grey-dark -mt-1 p-1 px-3 text-sm font-semibold rounded">
                                read more
                            </button>

                         </div>
                    </div>
                </div>

                 <div class="flex mt-8 pb-8">
                    <img class="rounded-full" src="/img/user.png" style="width: 45px;height: 45px;">

                    <div class="flex flex-col ml-4">
                        <a href="/discussions/show" class="no-underline">
                            <h4 class="text-xl text-blue-dark font-semibold">
                              Consectetur adipisicing elit.
                             </h4>
                         </a>
                         <span class="text-sm mt-2 text-black font-semibold">
                             Posted by :
                             <a class="no-underline text-blue" href="#">Abhishek Wani</a>
                         </span>

                         <div class="mt-4 text-lg text-black leading-normal">
                             Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                             quis nostrud exercitation ullamco laboris nisi.
                         </div>

                         <div class="mt-6 flex justify-between">
                            <div class="flex">
                                <span class="bg-grey-light mr-8 rounded text-md font-semibold text-grey-darker p-2">
                                    <i class="fa fa-circle text-red text-xs mr-2"></i> Olympiads
                                </span>

                                <span class="text-md font-semibold mr-6 text-grey-dark pt-2">
                                     <i class="fa fa-eye  mr-1"></i> 3 Visits
                                </span>

                                <span class="text-md font-semibold mr-6 text-grey-dark pt-2">
                                     <i class="fa fa-comments  mr-1"></i> 3 Replies
                                </span>
                            </div>

                            <button class="border  bg-white text-grey-dark -mt-1 p-1 px-3 text-sm font-semibold rounded">
                                read more
                            </button>

                         </div>
                    </div>
                </div>
          </div>
      </div>

    </div>


     @include('discussions.new-modal')
@endsection