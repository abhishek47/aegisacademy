<div class="bg-blue-lightest p-4 pr-55" style="min-height: 100vh; ">
    <div class="flex flex-col p-4 pl-0 pr-6 mx-3">
        <button @click="showModal('new-thread')" class="shadow bg-green hover:bg-green-dark rounded text-white p-3 px-6 font-semibold tracking-wide">
        Add New Thread
        </button>
        <span class="mt-6 text-grey-darker uppercase text-sm font-bold tracking-wide">Browse</span>
        <ul class="mt-2 list-reset">
            <li class="mt-2 text-md">
                <a href="/discussions" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ request()->is('discussions') ? 'text-blue-dark' : '' }}">
                    <i class="fa fa-comments mr-1"></i> All Threads
                </a>
            </li>
            <li class="mt-4 text-md">
                <a href="/discussions/filter:mine" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ request()->is('discussions/filter:mine') ? 'text-blue-dark' : '' }}">
                    <i class="fa fa-user mr-2"></i> My Threads
                </a>
            </li>
            <li class="mt-4 text-md">
                <a href="/discussions/filter:popular" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ request()->is('discussions/filter:popular') ? 'text-blue-dark' : '' }}">
                    <i class="fa fa-star mr-1"></i> Popular Threads
                </a>
            </li>
             <li class="mt-4 text-md">
                <a href="/discussions/filter:closed" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ request()->is('discussions/filter:closed') ? 'text-blue-dark' : '' }}">
                    <i class="fa fa-thumbs-up mr-1"></i> Closed Threads
                </a>
            </li>
            <li class="mt-4 text-md">
                <a href="/discussions/filter:unanswered" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ request()->is('discussions/filter:unanswered') ? 'text-blue-dark' : '' }}">
                    <i class="fas fa-question-circle mr-1"></i> Unanswered Threads
                </a>
            </li>
        </ul>
    </div>
</div>