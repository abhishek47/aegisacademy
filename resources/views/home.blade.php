@extends('layouts.app')

@section('content')
    <div class="bg-grey-lighter flex" style="min-height: 840px;">

        <div class="container md:mx-auto mt-8">
            <div class="flex flex-col shadow-md rounded bg-white p-4 border-4 border-brand border-l-0 border-b-0 border-r-0">
                <div class="flex border border-grey-dark border-l-0 border-t-0 border-r-0 pb-3">
                    <h3 class="flex-1 text-2xl font-semibold tracking-wide mt-1 ml-2">Problems of the week</h3>
                    <select class="border-2 border-brand p-2 rounded text-brand font-semibold tracking-wide text-md">
                        <option>1st Week of November</option>
                        <option>1st Week of November</option>
                        <option>1st Week of November</option>
                        <option>1st Week of November</option>

                    </select>
                </div>

                <div class="flex mt-6 ml-2">

                    <div class="w-3/5">
                        <div class="flex items-center text-xl font-semibold mb-8">
                             <a
                                class="shadow-md rounded-l rounded-sm bg-white border-t border-b border-l border-brand-light px-3 py-2 text-brand-dark hover:bg-brand-light hover:text-white no-underline"
                                href="#"
                                rel="prev"
                            >
                                &laquo;
                            </a>
                            <a class="bg-white  hover:bg-brand-light hover:bg-brand-dark bg-brand text-white shadow-md border-t border-b border-l  border-brand-light px-4 py-2  hover:text-white no-underline" href="#">1</a>
                            <a class="shadow-md border-t border-b border-l bg-white border-brand-light px-4 py-2 hover:bg-brand-light hover:text-white text-brand-dark no-underline" href="#">2</a>
                            <a class="shadow-md border-t border-b border-l border-r bg-white border-brand-light px-4 py-2 hover:bg-brand-light hover:text-white text-brand-dark no-underline" href="#">3</a>
                             <a class="shadow-md border-t border-b border-l border-r bg-white border-brand-light px-4 py-2 hover:bg-brand-light hover:text-white text-brand-dark no-underline" href="#">4</a>
                              <a class="shadow-md border-t border-b border-l border-r bg-white border-brand-light px-4 py-2 hover:bg-brand-light hover:text-white text-brand-dark no-underline" href="#">5</a>

                              <a
                                class="shadow-md rounded-r rounded-sm bg-white border-t border-b border-l border-r border-brand-light px-3 py-2 text-brand-dark hover:bg-brand-light hover:text-white no-underline"
                                href="#"
                                rel="next"
                            >
                                &raquo;
                            </a>
                        </div>

                    <span class="text-xl tracking-wide font-normal leading-normal">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                        <br><br>
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    </span>


                    <div class="flex mt-6">
                        <img class="mr-4" src="{{ asset('/img/studentsicon.png') }}" style="width: 70px;height: 100%;">
                        <div class="mt-3">
                            <p class="text-lg text-blue font-normal mb-2"><b class="font-semibold">40</b> people solved this.</p>
                             <p class="text-lg text-blue mt-1 font-normal"><b class="font-semibold">27</b> are discussing this question.</p>
                        </div>
                    </div>


                    </div>
                    <div class="flex flex-col w-2/5 p-3 pl-8 items-stretch justify-center">
                        <ul class="block w-4/5 list-reset mt-8 pt-3">
                            <li class="block w-full">
                                <a class="flex w-full block text-lg no-underline hover:bg-grey-lightest hover:rounded-2 p-2 tracking-wide" href="">
                                    <span class="border-2 border-grey-darker p-2 mr-4 bg-grey-lighter" style="width: 35px;height: 35px;border-radius: 100%;">
                                        <span class="bg-transparent " style="width: 34px;height: 24px;border-radius: 100%;"></span>
                                    </span>
                                    <span class="mt-2 text-black">Some options here</span>
                                </a>
                            </li>

                             <li class="block w-full">
                                <a class="flex w-full block text-lg no-underline hover:bg-grey-lightest hover:rounded-2 p-2 tracking-wide" href="">
                                    <span class="border-2 border-grey-darker p-2 mr-4 bg-grey-lighter" style="width: 35px;height: 35px;border-radius: 100%;">
                                        <span class="rounded-full h-6 w-6 bg-grey-darkest absolute -mt-1 -ml-1"></span>
                                    </span>
                                    <span class="mt-2 text-black">Another something</span>
                                </a>
                            </li>

                             <li class="block w-full">
                                <a class="flex w-full block text-lg no-underline hover:bg-grey-lightest hover:rounded-2 p-2 tracking-wide" href="">
                                    <span class="border-2 border-grey-darker p-2 mr-4 bg-grey-lighter" style="width: 35px;height: 35px;border-radius: 100%;">
                                        <span class="bg-transparent " style="width: 34px;height: 24px;border-radius: 100%;"></span>
                                    </span>
                                    <span class="mt-2 text-black">Might be this</span>
                                </a>
                            </li>

                             <li class="block w-full">
                                <a class="flex w-full block text-lg no-underline hover:bg-grey-lightest hover:rounded-2 p-2 tracking-wide" href="">
                                    <span class="border-2 border-grey-darker p-2 mr-4 bg-grey-lighter" style="width: 35px;height: 35px;border-radius: 100%;">
                                        <span class="bg-transparent " style="width: 34px;height: 24px;border-radius: 100%;"></span>
                                    </span>
                                    <span class="mt-2 text-black">Or else none</span>
                                </a>
                            </li>
                        </ul>

                        <button class="rounded bg-orange hover:bg-orange-dark p-2 px-8 mt-6 text-md text-white font-semibold tracking-wide ml-4 mr-8">
                            Submit
                        </button>

                          <button class="rounded border-2 border-brand hover:bg-brand font-semibold p-2 px-8 mt-6 text-md text-brand hover:text-white tracking-wide ml-4 mr-8">
                            View Solution
                        </button>

                    </div>
                </div>
            </div>

            <div class="container mx-auto flex mt-8" style="flex-wrap: wrap;">
            <a href="#" class="no-underline text-black w-1/2 pr-6 mb-8">
                <div class="rounded shadow-md bg-teal p-6 pt-4">
                    <div class="flex justify-between">
                     <span class="rounded bg-brand p-1 px-4 text-white tracking-wide text-sm">Topical</span>
                     <span class="text-sm font-semibold pt-1 text-white  tracking-wide">Wiki of the week</span>
                    </div>
                    <h3 class="w-full text-2xl font-semibold tracking-wide leading-normal mt-4 mb-4 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
                    <div class="flex flex-end">
                     <span class="flex-1 text-grey-darker"><i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i></span>
                     <span class="text-white font-semibold tracking-wide"><i class="fa fa-clock"></i> 23rd June 2018</span>
                    </div>
                </div>
            </a>

             <a href="#" class="no-underline text-black w-1/2 mb-8">
                <div class="rounded shadow-md bg-blue p-6 pt-4">
                     <div class="flex justify-between">
                     <span class="rounded bg-red p-1 px-4 text-white tracking-wide text-sm">Problematic</span>
                     <span class="text-sm font-semibold pt-1 text-white tracking-wide">Wiki of the week</span>
                    </div>
                    <h3 class="w-full text-2xl font-semibold text-white tracking-wide leading-normal mt-4 mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
                    <div class="flex flex-end">
                     <span class="flex-1 text-grey-darker"><i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star-half text-yellow"></i> </span>
                     <span class="text-white font-semibold tracking-wide "><i class="fa fa-clock"></i> 23rd June 2018</span>
                    </div>
                </div>
            </a>


        </div>
        </div>

    </div>
@endsection
