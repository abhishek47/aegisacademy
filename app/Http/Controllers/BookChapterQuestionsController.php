<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookChapterQuestion;

class BookChapterQuestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getQuestion(BookChapterQuestion $question)
    {
        return response(['body' => $question->question], 200);
    }


    public function getSolutions(BookChapterQuestion $question)
    {
        return response(['solutions' => $question->solutions], 200);
    }


}
