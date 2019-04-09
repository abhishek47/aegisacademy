<div  v-if="showSidebar" class="bg-blue-lightest p-4 pr-60" style="min-height: 100vh;max-width: 450px;width: 450px;">
    <div class="flex flex-col p-4 pl-0 pr-6 mx-3">
      {{--   <button class="shadow bg-transparent hover:bg-green border-2 border-green rounded text-green hover:text-white p-3 px-6 w-full font-semibold tracking-wide">
        <i class="fa fa-star mr-2"></i> Bookmark
        </button> --}}
        <span class="mt-6 text-grey-darker uppercase text-lg font-bold tracking-wide">Sections</span>
        <ul class="mt-2 list-reset">

            @foreach($chapter->sections as $section)
                <li class="chapter-item mt-3 text-md">
                    <a href="/courses/{{$course->slug}}/chapter:{{$chapter->slug}}/section:{{$section->slug}}" class="no-underline font-semibold tracking-wide hover:text-grey-darker leading-normal {{ request()->is('*/section:' . $section->slug) ? 'text-green' : ($section->completed ? 'text-grey-darker' : 'text-grey') }}">
                      <i class="fa fa-circle text-xs mr-2"></i> {{ $section->title }}
                    </a>
                </li>
            @endforeach

            </ul>
    </div>
</div>