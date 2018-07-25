<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProblemQuestion;
use App\Models\ProblemQuestionSolution;

class ProblemQuestionSolutionsController extends Controller
{

    public function store(ProblemQuestion $question)
    {
        $solution = $question->solutions()->create(['body' => request('comment'), 'user_id' => auth()->id()]);

        $solution->load(['question', 'user']);

        return response(['data' => $solution], 200);
    }

    public function upvote(ProblemQuestionSolution $solution)
    {
        auth()->user()->solutionUpvotes()->attach($solution);

        return response(['success'], 200);
    }

    public function downvote(ProblemQuestionSolution $solution)
    {
        auth()->user()->solutionUpvotes()->detach($solution);

        return response(['success'], 200);
    }

    public function update(ProblemQuestionSolution $solution)
    {
        $solution->update(['body' => request('comment')]);

        return response(['success'], 200);
    }

    public function destroy(ProblemQuestionSolution $solution)
    {
       $solution->delete();

        return response(['success'], 200);
    }
}
