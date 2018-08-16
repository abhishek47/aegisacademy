<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseChapter;
use App\Models\CourseChapterSection;
use Illuminate\Http\Request;

class CourseChaptersController extends Controller
{
    public function show($courseSlug, $chapterSlug, $sectionSlug = null)
    {
        $course = Course::where('slug', $courseSlug)->first();
        $chapter = CourseChapter::where('slug', $chapterSlug)->first();

        if($sectionSlug)
        {
            $section = CourseChapterSection::where('slug', $sectionSlug)->first();
            if($section->content_type != 2)
            {
              $section->markComplete();
            } else {
                if($section->problem->is_complete)
                {
                    $section->markComplete();
                }
            }

            if($chapter->sections()->count() == $chapter->sections()->completed()->count())
            {
                $section->chapter->finish();
            }

        } else {
            $section = $chapter->sections()->first();
            return redirect('/courses/' . $course->slug . '/chapter:' . $chapter->slug . '/section:' . $section->slug);
        }

        return view('coursechapters.show', compact('chapter', 'course', 'section'));
    }
}
