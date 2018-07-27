<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Problem;
use App\Models\Subject;
use App\Models\BookChapter;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $subjects = Subject::orderBy('name')->get();
        $books = Book::orderBy('title');
        $bookgroup = 'All books';

        if(request()->has('query'))
        {
                $books->where('title', 'LIKE', '%' . request('query') . '%');
                $bookgroup = $bookgroup . ' related to \'' . request('query') . '\'';
        }

        $books = $books->paginate(10);

        return view('books.index', compact('books', 'subjects', 'bookgroup'));
    }

    public function subject($slug)
    {
        $subjects = Subject::orderBy('name')->get();
        $subject = Subject::where('slug', $slug)->first();
        $books = $subject->books()->orderBy('title');
        $bookgroup = 'Books for <b class="font-semibold text-grey-darker">' . $subject->name . "</b>";

        if(request()->has('query'))
        {
                $books->where('title', 'LIKE', '%' . request('query') . '%');
                $bookgroup = $bookgroup . ' related to \'' . request('query') . '\'';
        }
        $books = $books->paginate(10);

        return view('books.index', compact('books', 'subjects', 'subject', 'bookgroup'));
    }

    public function show($subjectSlug, $slug)
    {
        $subject = Subject::where('slug', $subjectSlug)->first();
        $book = Book::where('slug', $slug)->first();
        $problem = Problem::first();
        $startChapter = $book->chapters()->first();
        return view('books.show', compact('subject', 'book', 'startChapter'));
        //return redirect('/books/' . $subject->name . '/' . $book->slug . '/chapter:' . $currentChapter->id);
    }


    public function chapter($subjectSlug, $slug, BookChapter $chapter)
    {
         $subject = Subject::where('slug', $subjectSlug)->first();
         $book = Book::where('slug', $slug)->first();
         $problem = Problem::first();
         $currentChapter = $chapter;
         return view('books.chapter', compact('subject', 'book', 'problem', 'currentChapter'));
    }
}
