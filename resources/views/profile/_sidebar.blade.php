<div class="bg-blue-lightest p-4" style="min-height: 800px;">
    <div class="flex flex-col p-4 pl-0  mx-3">

        <div class="flex flex-col items-center justify-center">
            <img class="rounded-full" src="/img/user.png" style="width: 100px;height: 100px;">

            <h2 class="mt-4 text-xl tracking-wide text-center text-grey-darkest">{{ auth()->user()->name }}</h2>
            <h2 class="mt-2 text-lg tracking-wide text-center text-grey-darker">{{ auth()->user()->xp }} XP</h2>
        </div>

        <ul class="mt-4 list-reset pt-2 border-t">
                <li class="mt-3 mr-8 text-md">
                    <a href="#" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ request()->is('profile') ? 'text-blue-dark' : '' }} leading-normal">
                        <i class="fa fa-chevron-right mr-1"></i> My Profile
                    </a>
                </li>

                <li class="mt-3 mr-8 text-md">
                    <a href="/profile/acheivements" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ request()->is('profile/acheivements') ? 'text-blue-dark' : '' }} leading-normal">
                        <i class="fa fa-chevron-right mr-1"></i> Acheivements
                    </a>
                </li>

                 <li class="mt-3 mr-8 text-md">
                    <a href="#" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ request()->is('/profile') ? 'text-blue-dark' : '' }} leading-normal">
                        <i class="fa fa-chevron-right mr-1"></i> Security
                    </a>
                </li>

        </ul>
    </div>
</div>