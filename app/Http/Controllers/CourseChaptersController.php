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
        } else {
            $section = $chapter->sections()->first();
        }

        return view('coursechapters.show', compact('chapter', 'course', 'section'));
    }
}
