<div class="flex mt-8">
      <img class="rounded-full" src="/img/user.png" style="width: 45px;height: 45px;">
      <div class="flex flex-col ml-4 w-full">
            <a href="#" class="no-underline">
              <h4 class="text-xl text-blue-dark font-semibold">
              {{ $discussion->title }}
              </h4>
            </a>

            <span class="text-sm mt-2 text-black font-semibold">
              Posted by :
              <a class="no-underline text-blue mr-2" href="#">{{ $discussion->user->name }}</a>
              @if(auth()->user()->isCreaterOf($discussion))
              | <a class="no-underline hover:underline text-grey-darker mr-2 ml-1" @click.prevent="showModal('edit-thread')"  href="#">Edit</a>
              | <a class="no-underline hover:underline text-grey-darker ml-1" href="/discussions/{{$discussion->id}}/delete">Delete</a>
              @endif
            </span>

            <div class="mt-4 text-lg text-black leading-normal">
              <platex body="{{ $discussion->body }}"></platex>
            </div>
            <hr class="w-full border-grey-lighter border mt-8">
            @foreach($discussion->replies as $reply)
              <div>
                <thread-reply :owned-thread={{ auth()->user()->isCreaterOf($discussion) ? 'true' : 'false' }} reply-data="{{ json_encode($reply) }}"></thread-reply>
              </div>
            @endforeach
    </div>
</div>

