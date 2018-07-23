@extends('layouts.app')

@section('content')
<div class="bg-grey-lightest flex pt-60 px-6 md:px-0" style="min-height: 600px;">
    <div class="w-full max-w-xs mx-auto">
  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
     <div class="mb-4">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="name">
        Fullname
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight  {{ $errors->has('name') ? 'mb-3 border-red-dark' : 'border-grey-light' }}" id="name" name="name" type="text" placeholder="Your name">
       {!! $errors->first('name', '<p class="text-red text-xs italic">:message</p>') !!}
    </div>

    <div class="mb-4">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
        E-mail Address
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight  {{ $errors->has('email') ? 'mb-3 border-red-dark' : 'border-grey-light' }}" id="email" name="email" type="text" placeholder="E-Mail Address">
       {!! $errors->first('email', '<p class="text-red text-xs italic">:message</p>') !!}
    </div>
    <div class="mb-4">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
        Password
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight {{ $errors->has('password') ? 'mb-3 border-red-dark' : 'border-grey-light' }}" id="password" name="password" type="password" placeholder="Your password">
       {!! $errors->first('password', '<p class="text-red text-xs italic">:message</p>') !!}

    </div>
    <div class="mb-6">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
        Confirm Password
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight {{ $errors->has('password_confirmation') ? 'mb-3 border-red-dark' : 'border-grey-light' }}" id="password_confirmation" name="password_confirmation" type="password" placeholder="Your password">
       {!! $errors->first('password_confirmation', '<p class="text-red text-xs italic">:message</p>') !!}

    </div>
    <div class="flex items-stretch">
      <button class="w-full bg-brand hover:bg-brand-dark text-white font-bold py-2 px-4 rounded" type="submit">
        Create Account
      </button>

    </div>
  </form>
  <p class="text-center text-grey text-sm">
   Already have an account? <a href="{{ url('/login') }}" class="no-underline text-grey font-semibold hover:underline">Sign In</a>.
  </p>
</div>

</div>
@endsection
