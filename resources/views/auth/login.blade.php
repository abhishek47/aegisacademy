@extends('layouts.app')

@section('content')
<div class="bg-grey-lightest flex pt-60 px-6 md:px-0" style="min-height: 600px;">
    <div class="w-full max-w-xs mx-auto">
  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="mb-4">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
        E-mail Address
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker  mb-3 leading-tight  {{ $errors->has('email') ? 'border-red-dark' : 'border-grey-light' }}" id="email" name="email" type="text" placeholder="E-Mail Address">
       {!! $errors->first('email', '<p class="text-red text-xs italic">:message</p>') !!}
    </div>
    <div class="mb-6">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
        Password
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight {{ $errors->has('password') ? 'border-red-dark' : 'border-grey-light' }}" id="password" name="password" type="password" placeholder="Your password">
       {!! $errors->first('password', '<p class="text-red text-xs italic">:message</p>') !!}

    </div>
    <div class="flex items-center justify-between">
      <button class="bg-brand hover:bg-brand-dark text-white font-bold py-2 px-4 rounded" type="submit">
        Sign In
      </button>
      <a class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker" href="{{ route('password.request') }}">
        Forgot Password?
      </a>
    </div>
  </form>
  <p class="text-center text-grey text-sm">
   Don't have an account? <a href="{{ url('/register') }}" class="no-underline text-grey font-semibold hover:underline">Sign up</a>.
  </p>
</div>

</div>
@endsection
