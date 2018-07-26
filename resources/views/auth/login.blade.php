@extends('layouts.app')

@section('content')
<div class="bg-grey-lightest bg-cover bg-no-repeat  flex pt-60 px-6 md:px-0" style="min-height: 840px;">

    <div class="w-full max-w-md mx-auto">
      <h2 class="my-30 text-left text-brand tracking-wide text-3xl">
        Login to your account
      </h2>
  <form class="bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="mb-4">
      <label class="block text-grey-darker text-md font-bold mb-2" for="email">
        E-mail Address
      </label>
      <input class="shadow appearance-none border rounded w-full py-4 px-3 text-grey-darker  mb-3 leading-tight  {{ $errors->has('email') ? 'border-red-dark' : 'border-grey-light' }}" id="email" name="email" type="text" placeholder="E-Mail Address">
       {!! $errors->first('email', '<p class="text-red text-xs italic">:message</p>') !!}
    </div>
    <div class="mb-6">
      <label class="block text-grey-darker text-md font-bold mb-2" for="password">
        Password
      </label>
      <input class="shadow appearance-none border rounded w-full py-4 px-3 text-grey-darker mb-3 leading-tight {{ $errors->has('password') ? 'border-red-dark' : 'border-grey-light' }}" id="password" name="password" type="password" placeholder="Your password">
       {!! $errors->first('password', '<p class="text-red text-xs italic">:message</p>') !!}

    </div>
    <div class="flex items-center justify-between">
      <button class="bg-brand hover:bg-brand-dark text-white font-bold py-3 px-8 rounded" type="submit">
        Sign In
      </button>
      <a class="no-underline inline-block align-baseline font-bold text-lg text-grey-darker hover:text-blue-darker tracking-wide" href="{{ route('password.request') }}">
        Forgot Password?
      </a>
    </div>
  </form>
  <p class="text-center text-brand text-lg tracking-wide">
   Don't have an account? <a href="{{ url('/register') }}" class="no-underline text-brand font-semibold hover:underline">Sign up</a>.
  </p>
</div>

</div>
@endsection
