<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($subjectSlug = null)
    {
        $subjects = Subject::orderBy('name')->get();
        $coursegroup = "All Courses";
        $cursubject = null;

       if(isset($subjectSlug))
        {
            $cursubject = Subject::where('slug', $subjectSlug)->first();
           $courses = Course::where('subject_id', $cursubject->id)->orderBy('created_at', "DESC");
           $coursegroup = $cursubject->name  . ' Courses';
        } else {
           $courses = Course::orderBy('created_at', "DESC");
        }

        if(request()->has('query') && request('query') != '')
        {
            $courses = $courses->where('title', 'Like', '%' . request('query') . '%')->paginate(10);
            $coursegroup = $coursegroup . ' related to \'' . request('query') . '\'';
        } else {
            $courses = $courses->paginate(10);
        }


        return view('courses.index', compact('subjects', 'cursubject', 'courses', 'coursegroup'));
    }


    public function show($courseSlug)
    {
        $course = Course::where('slug', $courseSlug)->first();

        return view('courses.show', compact('course'));

    }

}
