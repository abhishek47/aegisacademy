<div class="bg-blue-lightest p-4 pr-60" style="min-height: 800px;">
    <div class="flex flex-col p-4 pl-0 pr-6 mx-3">
        <span class="mt-6 text-grey-darker uppercase text-lg font-bold tracking-wide">Topics</span>
        <ul class="mt-2 list-reset">
            <li class="mt-3 text-md">
                    <a href="/wiki" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ $categoryId == null  ? 'text-blue-dark' : '' }} leading-normal">
                        <i class="fa fa-circle text-xs mr-2 text-grey-darker" ></i> All
                    </a>
                </li>
            @foreach($categories as $category)
                <li class="mt-3 text-md">
                    <a href="/wiki/category:{{$category->id}}" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ $categoryId == $category->id  ? 'text-blue-dark' : '' }} leading-normal">
                        <i class="fa fa-circle text-xs mr-2" style="color: {{ $category->color->code  }} "></i> {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>