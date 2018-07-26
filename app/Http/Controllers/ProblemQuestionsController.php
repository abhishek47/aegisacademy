<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProblemQuestion;

class ProblemQuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getQuestion(ProblemQuestion $question)
    {
        return response(['body' => $question->question], 200);
    }

    public function answer(ProblemQuestion $question)
    {
        auth()->user()->solvedProblemQuestions()->attach($question, ['answer' => request('answer'), 'is_correct' => request('is_correct')]);

        return response(['success'], 200);
    }

    public function getSolutions(ProblemQuestion $question)
    {
        return response(['solutions' => $question->solutions], 200);
    }
}
