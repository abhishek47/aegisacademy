@extends('layouts.app')


@section('content')

    <div class="bg-grey-lighter" >
        <div class="flex container mx-auto bg-white shadow" style="min-height: 800px;">

            @include('profile._sidebar')

            <div class="w-3/4 p-6 pl-8">
                <div class="flex flex-wrap">

                        <div class="mb-4 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white  p-3 px-8">
                                <img class="" src="/img/badges/learner.png" style="width: 100px;height: 100px;">
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Learner</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">2000 XP</p>
                            </div>
                        </div>

                         <div class="mb-4 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white  p-3 px-8">
                                <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Beginner</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">4000 XP</p>
                            </div>

                        </div>

                         <div class="mb-4 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white p-3 px-8">
                                <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Practitioner</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">7000 XP</p>
                            </div>
                        </div>

                         <div class="mb-4 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white p-3 px-8">
                                <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Strike</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">10000 XP</p>
                            </div>
                        </div>

                         <div class="mt-6 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white  p-3 px-8">
                                <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Intermediate</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">15000 XP</p>
                            </div>
                        </div>

                         <div class="mt-6 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white p-3 px-8">
                                <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Advance</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">18000 XP</p>
                            </div>
                        </div>

                          <div class="mt-6 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white  px-8">
                                <img class="" src="/img/badges/lock.png" style="width: 110px;height: 110px;">
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Expert</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">22000 XP</p>
                            </div>
                        </div>

                          <div class="mt-6 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white  p-3 px-8">
                                <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Tutor</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">28000 XP</p>
                            </div>
                        </div>


                </div>
            </div>
        </div>

    </div>

@endsection