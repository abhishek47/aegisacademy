<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookChapterQuestion;
use App\Models\BookChapterQuestionSolution;

class BookChapterQuestionSolutionController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(BookChapterQuestion $question)
    {
        $solution = $question->solutions()->create(['body' => request('comment'), 'user_id' => auth()->id()]);

        $solution->load(['question', 'user']);

        return response(['data' => $solution], 200);
    }

    public function upvote(BookChapterQuestionSolution $solution)
    {
        auth()->user()->chapterSolutionUpvotes()->attach($solution);

        return response(['success'], 200);
    }

    public function downvote(BookChapterQuestionSolution $solution)
    {
        auth()->user()->chapterSolutionUpvotes()->detach($solution);

        return response(['success'], 200);
    }

    public function update(BookChapterQuestionSolution $solution)
    {
        $solution->update(['body' => request('comment')]);

        return response(['success'], 200);
    }

    public function destroy(BookChapterQuestionSolution $solution)
    {
       $solution->delete();

        return response(['success'], 200);
    }
}
