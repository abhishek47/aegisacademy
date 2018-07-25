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

                <practice-problems problem-set="{{ $problem }}"></practice-problems>
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
