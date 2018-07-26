<div class="bg-blue-lightest p-4" style="min-height: 800px;">
    <div class="flex flex-col p-4 pl-0 pr-6 mx-3">
        <span class="mt-6 text-grey-darker uppercase text-lg font-bold tracking-wide">Topics</span>
        <ul class="mt-2 list-reset">
            @foreach($subject->topics as $topic)
                <li class="mt-3 text-md">
                    <a href="/practice/{{$subject->slug}}/topic:{{$topic->id}}" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ request()->is('*topic:' . $topic->id) ? 'text-blue-dark' : '' }} leading-normal">
                        <i class="fa fa-chevron-right mr-1"></i> {{ $topic->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>