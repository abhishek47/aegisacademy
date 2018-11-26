<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Wiki;
use App\Models\Course;
use App\Models\Problem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$problem = Problem::first();
        $wikis = Wiki::latest()->limit(8)->get();

        $problems = Problem::where('topic_id', '!=', null)->get()->filter(function ($problem, $key) {
            return $problem->is_ongoing;
        })->slice(0, 2);

        $books = Book::all()->filter(function ($book, $key) {
            return $book->is_ongoing;
        })->slice(0, 3);

        $courses = Course::all()->filter(function ($course, $key) {
            return $course->ongoing;
        })->slice(0, 4);

        return view('home', compact('wikis', 'problems', 'books', 'courses'));
    }
}
