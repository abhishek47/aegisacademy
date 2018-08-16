<div class="bg-blue-lightest p-4 pr-60" style="min-height: 100vh;">
    <div class="flex flex-col p-4 pl-0 pr-6 mx-3">
        <span class="mt-6 text-grey-darker uppercase text-lg font-bold tracking-wide">Subjects</span>
        <ul class="mt-2 list-reset">
            <li class="mt-3 text-md">
                    <a href="/books" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ request()->is('books')  ? 'text-blue-dark' : '' }} leading-normal">
                         All
                    </a>
                </li>
            @foreach($subjects as $subject)
                <li class="mt-3 text-md">
                    <a href="/books/{{$subject->slug}}" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ request()->is('books/' . $subject->slug)  ? 'text-blue-dark' : '' }} leading-normal">
                       {{ $subject->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>