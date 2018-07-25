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
                <span class="text-blue-dark text-sm font-semibold tracking-wide">
                 <a href="/discussions" class="no-underline text-blue-dark hover:text-brand"> All Threads </a> <i class="fa fa-chevron-right text-grey-dark"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                 </span>

                <div class="flex mt-8">
                    <img class="rounded-full" src="/img/user.png" style="width: 45px;height: 45px;">

                    <div class="flex flex-col ml-4">
                        <a href="/discussions/show" class="no-underline">
                            <h4 class="text-xl text-blue-dark font-semibold">
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                             </h4>
                         </a>
                         <span class="text-sm mt-2 text-black font-semibold">
                             Posted by :
                             <a class="no-underline text-blue mr-2" href="#">Abhishek Wani</a>
                             | <a class="no-underline hover:underline text-grey-darker mr-2 ml-1" href="#">Edit</a>
                             | <a class="no-underline hover:underline text-grey-darker ml-1" href="#">Delete</a>
                         </span>

                         <div class="mt-4 text-lg text-black leading-normal">
                             Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                             quis nostrud exercitation ullamco laboris nisi.
                         </div>



                           <hr class="w-full border-grey-lighter border mt-8">

                           <div>
                           <div class="flex mt-6">
                                 <img class="rounded-full" src="/img/user.png" style="width: 40px;height: 40px;">
                           <div class="flex flex-col ml-4">

                            <div class="flex mt-3">
                              <a href="/discussions/show" class="no-underline">
                                <h4 class="text-lg -mt-1 text-blue-dark font-semibold">
                                  Jhon Doe

                                 </h4>
                               </a>

                               <a href="#" class="no-underline border-grey border-l pl-3 border-r-0 border-y-0 text-sm hover:underline  text-blue-dark font-normal tracking-wide ml-4" style="margin-top: -2px;">Edit</a>
                               </div>
                             <div class="mt-6 text-lg text-black leading-normal">
                                 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                 quis nostrud exercitation ullamco laboris nisi.
                             </div>

                             <hr class="w-full border-grey-lighter border mt-8">
                           </div>
                        </div>

                        <div class="flex mt-6">
                                 <img class="rounded-full" src="/img/user.png" style="width: 40px;height: 40px;">
                           <div class="flex flex-col ml-4">

                            <div class="flex mt-3">
                              <a href="/discussions/show" class="no-underline">
                                <h4 class="text-lg -mt-1 text-blue-dark font-semibold">
                                  Jhon Doe

                                 </h4>
                               </a>

                               <a href="#" class="no-underline border-grey border-l pl-3 border-r-0 border-y-0 text-sm hover:underline  text-blue-dark font-normal tracking-wide ml-4" style="margin-top: -2px;">Edit</a>
                               </div>
                             <div class="mt-6 text-lg text-black leading-normal">
                                 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                 quis nostrud exercitation ullamco laboris nisi.
                             </div>

                             <hr class="w-full border-grey-lighter border mt-8">
                           </div>
                        </div>




                        </div>
                    </div>
                </div>
          </div>
      </div>

    </div>


     @include('discussions.new-modal')
@endsection