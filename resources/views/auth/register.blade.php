@extends('layouts.app')

@section('content')
<div class="bg-grey-lightest bg-cover bg-no-repeat flex pt-60 px-6 md:px-0" style="min-height: 840px;">
    <div class="w-full max-w-md mx-auto">
       <h2 class="my-30 text-left text-brand tracking-wide text-3xl">
         Begin your journey to learn smart!
      </h2>
  <form class="bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
     <div class="mb-4">
      <label class="block text-grey-darker text-md font-bold mb-2" for="name">
        Fullname
      </label>
      <input class="shadow appearance-none border rounded w-full py-4 px-3 text-grey-darker leading-tight  {{ $errors->has('name') ? 'mb-3 border-red-dark' : 'border-grey-light' }}" id="name" name="name" type="text" placeholder="Your name">
       {!! $errors->first('name', '<p class="text-red text-xs italic">:message</p>') !!}
    </div>

    <div class="mb-4">
      <label class="block text-grey-darker text-md font-bold mb-2" for="email">
        E-mail Address
      </label>
      <input class="shadow appearance-none border rounded w-full py-4 px-3 text-grey-darker leading-tight  {{ $errors->has('email') ? 'mb-3 border-red-dark' : 'border-grey-light' }}" id="email" name="email" type="text" placeholder="E-Mail Address">
       {!! $errors->first('email', '<p class="text-red text-xs italic">:message</p>') !!}
    </div>
    <div class="mb-4">
      <label class="block text-grey-darker text-md font-bold mb-2" for="password">
        Password
      </label>
      <input class="shadow appearance-none border rounded w-full py-4 px-3 text-grey-darker leading-tight {{ $errors->has('password') ? 'mb-3 border-red-dark' : 'border-grey-light' }}" id="password" name="password" type="password" placeholder="Your password">
       {!! $errors->first('password', '<p class="text-red text-xs italic">:message</p>') !!}

    </div>
    <div class="mb-6">
      <label class="block text-grey-darker text-md font-bold mb-2" for="password">
        Confirm Password
      </label>
      <input class="shadow appearance-none border rounded w-full py-4 px-3 text-grey-darker leading-tight {{ $errors->has('password_confirmation') ? 'mb-3 border-red-dark' : 'border-grey-light' }}" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm password">
       {!! $errors->first('password_confirmation', '<p class="text-red text-xs italic">:message</p>') !!}

    </div>
    <div class="flex items-stretch">
      <button class="w-full bg-brand hover:bg-brand-dark text-white font-bold py-4 px-8 rounded tracking-wide" type="submit">
        Create Account
      </button>

    </div>
  </form>
  <p class="text-center text-brand text-lg tracking-wide">
   Already have an account? <a href="{{ url('/login') }}" class="no-underline text-brand font-semibold hover:underline">Sign In</a>.
  </p>
</div>

</div>
@endsection
