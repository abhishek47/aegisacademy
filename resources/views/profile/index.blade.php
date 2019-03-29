@extends('layouts.app')
@section('content')
<div class="bg-grey-lighter" >
    <div class="flex container mx-auto bg-white shadow" style="min-height: 100vh;">
        @include('profile._sidebar')
        <div class="w-3/4 p-6 pl-8">
            <div class="flex flex-col shadow-md rounded bg-white p-4 border-4 border-brand border-l-0 border-b-0 border-r-0 ml-2 ">
                <h3 class="flex-1 text-2xl font-semibold tracking-wide mt-1 border-b pb-3">Edit Profile Details</h3>

                <form class="mt-4" method="POST" action="/profile">
                    {{ csrf_field() }}
                    <div class="mb-4">
                        <label class="block text-grey-darker text-md font-bold mb-2" for="name">
                            Your Name
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-4 px-3 text-grey-darker leading-tight  {{ $errors->has('name') ? 'mb-3 border-red-dark' : 'border-grey-light' }}" id="name" value="{{ auth()->user()->name }}" name="name" type="text" placeholder="Your name">
                        {!! $errors->first('name', '<p class="text-red text-xs italic">:message</p>') !!}
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-md font-bold mb-2" for="email">
                            E-mail Address
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-4 px-3 text-grey-darker leading-tight  {{ $errors->has('email') ? 'mb-3 border-red-dark' : 'border-grey-light' }}" id="email" value="{{ auth()->user()->email }}" name="email" type="text" placeholder="E-Mail Address">
                        {!! $errors->first('email', '<p class="text-red text-xs italic">:message</p>') !!}
                    </div>

                    <div class="flex items-stretch">
                      <button class="w-full bg-orange hover:bg-orange-dark text-white font-bold py-4 px-8 rounded tracking-wide" type="submit">
                        Update Profile
                      </button>

                    </div>
                </form>
            </div>

            <div class="flex flex-col shadow-md rounded bg-white p-4 border-4 border-brand border-l-0 border-b-0 border-r-0 ml-2 mt-6">

                 <div class="flex items-center justify-between">

                        @if(auth()->user()->is_premium)
                            <div>
                                <h2 class="text-black font-semibold tracking-wide text-2xl">Premium Plan (₹ 1500 / year)</h2>
                                <p class="text-grey-dark tracking-wide leading-normal mt-3">You have access to all premium content.</p>
                            </div>

                            <a href="/profile/downgrade"  class="no-underline btn flex bg-red hover:bg-red-dark ml-8 mr-4 mt-2 text-white font-semibold uppercase p-3 rounded  tracking-wide text-sm px-8">
                                       Downgrage
                                     </a>
                        @else
                            <div>
                                <h2 class="text-black font-semibold tracking-wide text-2xl">Free Plan (Rs. 0 / year)</h2>
                                <p class="text-grey-dark tracking-wide leading-normal mt-3">Upgrade to premium and learn with more content.</p>
                            </div>

                             <a href="/profile/upgrade"  class="no-underline btn flex bg-green hover:bg-green-dark ml-8 mr-4 mt-2 text-white font-semibold uppercase p-3 rounded  tracking-wide text-sm px-8">
                                       Be Premium
                                     </a>
                        @endif



                 </div>

            </div>
        </div>
    </div>
</div>
@endsection