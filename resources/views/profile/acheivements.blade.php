@extends('layouts.app')


@section('content')

    <div class="bg-grey-lighter" >
        <div class="flex container mx-auto bg-white shadow" style="min-height: 100vh;">

            @include('profile._sidebar')

            <div class="w-3/4 p-6 pl-8">
                <h2 class="mb-8 ml-4 mt-4">My Badges</h2>
                <div class="flex flex-wrap">

                        <div class="mb-4 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white  p-3 px-8">
                                @if(auth()->user()->xp >= 1000)
                                    <img class="" src="/img/badges/learner.png" style="width: 100px;height: 100px;">
                                @else
                                    <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                @endif
                                    <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Learner</h2>
                                    <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">1000 XP</p>

                            </div>
                        </div>

                         <div class="mb-4 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white  p-3 px-8">
                                @if(auth()->user()->xp >= 2500)
                                    <img class="" src="/img/badges/beginner.png" style="width: 100px;height: 100px;">
                                @else
                                    <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                @endif
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Beginner</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">2500 XP</p>
                            </div>

                        </div>

                         <div class="mb-4 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white p-3 px-8">
                                @if(auth()->user()->xp >= 4000)
                                    <img class="" src="/img/badges/practitioner.png" style="width: 100px;height: 100px;">
                                @else
                                    <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                @endif
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Practitioner</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">4000 XP</p>
                            </div>
                        </div>

                         <div class="mb-4 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white p-3 px-8">
                                 @if(auth()->user()->xp >= 4000)
                                    <img class="" src="/img/badges/strike.png" style="width: 100px;height: 100px;">
                                @else
                                    <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                @endif
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Strike</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">7000 XP</p>
                            </div>
                        </div>

                         <div class="mt-6 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white  p-3 px-8">
                                @if(auth()->user()->xp >= 12000)
                                    <img class="" src="/img/badges/intermediate.png" style="width: 100px;height: 100px;">
                                @else
                                    <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                @endif
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Intermediate</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">12000 XP</p>
                            </div>
                        </div>

                         <div class="mt-6 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white p-3 px-8">
                                @if(auth()->user()->xp >= 17000)
                                    <img class="" src="/img/badges/advance.png" style="width: 100px;height: 100px;">
                                @else
                                    <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                @endif
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Advance</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">17000 XP</p>
                            </div>
                        </div>

                          <div class="mt-6 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white  px-8">
                                @if(auth()->user()->xp >= 22000)
                                    <img class="" src="/img/badges/expert.png" style="width: 100px;height: 100px;">
                                @else
                                    <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                @endif
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Expert</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">22000 XP</p>
                            </div>
                        </div>

                          <div class="mt-6 mr-4">
                            <div class="w-full flex flex-col items-center justify-center  bg-white  p-3 px-8">
                                @if(auth()->user()->xp >= 28000)
                                    <img class="" src="/img/badges/tutor.png" style="width: 100px;height: 100px;">
                                @else
                                    <img class="" src="/img/badges/lock.png" style="width: 100px;height: 100px;">
                                @endif
                                <h2 class="font-semibold tracking-wide text-xl mt-6 text-brand uppercase">Tutor</h2>
                                <p class="font-semibold text-lg tracking-wide text-grey-darker mt-2">28000 XP</p>
                            </div>
                        </div>


                </div>
            </div>
        </div>

    </div>

@endsection