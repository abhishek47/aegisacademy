<div class="flex mt-8  pb-8 border-t-0 border-x-0 border-b border-grey-light">
    <img class="rounded-full" src="/img/user.png" style="width: 45px;height: 45px;">
    <div class="flex flex-col ml-4 w-full">
        <a href="{{ url('/discussions/' . $discussion->id) }}" class="no-underline">
            <h4 class="text-xl text-blue-dark font-semibold">
            {{ $discussion->title }}
            </h4>
        </a>
        <span class="text-sm mt-2 text-black font-semibold">
            Posted by :
            <a class="no-underline text-blue" href="#">{{ $discussion->user->name }}</a>
        </span>
        <div class="mt-4 text-lg text-black leading-normal">
        <platex body="{{ $discussion->body }}"></platex>
    </div>
    <div class="mt-6 flex justify-between">
        <div class="flex">
            <span class="bg-grey-light mr-8 rounded text-md font-semibold text-grey-darker p-2">
                @if($discussion->is_closed)
                    <i class="fa fa-circle text-red text-xs mr-2"></i> Closed
                @else
                    <i class="fa fa-circle text-green text-xs mr-2"></i> Open
                @endif
            </span>
           {{--  <span class="text-md font-semibold mr-6 text-grey-dark pt-2">
                <i class="fa fa-eye  mr-1"></i> 0 Visits
            </span> --}}
            <span class="text-md font-semibold mr-6 text-grey-dark pt-2">
                <i class="fa fa-comments  mr-1"></i> {{ $discussion->replies->count() }} Replies
            </span>
        </div>
        <a href="{{ url('/discussions/' . $discussion->id) }}" class="no-underline border  bg-white text-grey-dark -mt-1 pb-1 pt-2 px-3 text-sm font-semibold rounded">
            read more
        </a>
    </div>
</div>
</div>