
@extends('layouts.app')

@section('content')
<div class="bg-grey-lightest bg-cover bg-no-repeat  flex pt-60 px-6 md:px-0" style="min-height: 840px;">

    <div class="w-full max-w-md mx-auto">
      <h2 class="my-30 text-left text-brand tracking-wide text-3xl">
        Reset Password
      </h2>
  <form class="bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('password.email') }}">

    @if (session('status'))
        <div class="bg-green-lightest border border-green-light text-green-dark text-sm px-4 py-3 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    {{ csrf_field() }}
    <div class="mb-4">
      <label class="block text-grey-darker text-md font-bold mb-2" for="email">
        E-mail Address
      </label>
      <input class="shadow appearance-none border rounded w-full py-4 px-3 text-grey-darker  mb-3 leading-tight  {{ $errors->has('email') ? 'border-red-dark' : 'border-grey-light' }}" id="email" name="email" type="text" placeholder="E-Mail Address">
       {!! $errors->first('email', '<p class="text-red text-xs italic">:message</p>') !!}
    </div>

    <div class="flex items-stretch justify-between">
      <button class="w-full bg-brand hover:bg-brand-dark text-white font-bold py-4 px-8 rounded" type="submit">
        Send Password Reset Link
      </button>

    </div>
  </form>

</div>

</div>
@endsection



