<div class="bg-blue-lightest p-4 pr-60" style="min-height: 100vh;">
    <div class="flex flex-col p-4 pl-0 pr-6 mx-3">
        <span class="mt-6 text-grey-darker uppercase text-lg font-bold tracking-wide">Subjects</span>
        <ul class="mt-2 list-reset">
             <li class="mt-3 text-md">
                    <a href="/courses"  class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ request()->is('courses') ? 'text-blue-dark' : '' }} leading-normal">
                        <i class="fa fa-circle text-xs mr-2"></i> All Courses
                    </a>
                </li>
            @foreach($subjects as $subject)
             @if($subject->courses()->count())
                <li class="mt-3 text-md">
                <a href="/courses/subject:{{$subject->slug}}" class="no-underline font-semibold tracking-wide text-grey-darker hover:text-blue-dark {{ isset($cursubject) && $cursubject->id == $subject->id ? 'text-blue-dark' : '' }}  leading-normal">
                        <i class="fa fa-circle text-xs mr-2"></i> {{ str_limit($subject->name, 18) }}
                    </a>
                </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>