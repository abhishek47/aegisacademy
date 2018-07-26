@extends('layouts.app')
@section('content')
<div class="bg-grey-lightest">
  <div class="flex bg-white shadow container md:mx-auto" style="min-height: 800px;">

    @include('discussions._sidebar')

    <div class="w-3/4 p-6 pl-8">
      <span class="text-blue-dark text-sm font-semibold tracking-wide">
        <a href="/discussions" class="no-underline text-blue-dark hover:text-brand">
          {{ isset($threadgroup) ? $threadgroup : 'All Threads' }}
        </a>
        <i class="fa fa-chevron-right text-grey-dark"></i> {{ $discussion->title }}
      </span>

      @include('discussions._show')

      @include('discussions._newReply')

    </div>
  </div>
</div>
@include('discussions.new-modal')

<edit-thread thread="{{ json_encode($discussion) }}"></edit-thread>
@endsection