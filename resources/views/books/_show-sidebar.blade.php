<div class="bg-blue-lightest p-4 pr-60" style="min-height: 800px;">
    <div class="flex flex-col p-4 pl-0 pr-6 mx-3">
      {{--   <button class="shadow bg-transparent hover:bg-green border-2 border-green rounded text-green hover:text-white p-3 px-6 w-full font-semibold tracking-wide">
        <i class="fa fa-star mr-2"></i> Bookmark
        </button> --}}
        <span class="mt-6 text-grey-darker uppercase text-lg font-bold tracking-wide">Chapters</span>
        <ul class="mt-2 list-reset">

            <li class="chapter-item mt-3 text-md">
                  <a href="/books/{{$book->subject->slug}}/{{$book->slug}}" class="no-underline font-semibold tracking-wide hover:text-grey-darker leading-normal {{ !isset($currentChapter) ? 'text-grey-darker' : 'text-grey' }}">
                    <i class="fa fa-book text-xs mr-2"></i> Book Summary
                  </a>
              </li>

            @foreach($book->chapters as $chapter)
                <li class="chapter-item mt-3 text-md">
                    <a href="/books/{{$book->subject->slug}}/{{$book->slug}}/chapter:{{$chapter->id}}" class="no-underline font-semibold tracking-wide hover:text-grey-darker leading-normal {{ request()->is('*/chapter:' . $chapter->id) ? 'text-grey-darker' : 'text-grey' }}">
                      <i class="fa fa-circle text-xs mr-2"></i> {{ $chapter->name }}
                    </a>
                </li>
            @endforeach

            </ul>
    </div>
</div>