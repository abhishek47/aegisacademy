<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Problem;
use App\Models\Subject;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $subjects = Subject::orderBy('name')->get();
        return view('practice.index', compact('subjects'));
    }

    public function subject($slug)
    {
        $subject = Subject::where('slug', $slug)->first();

        if($subject->topics->count())
        {
            return redirect('/practice/' . $subject->slug . '/topic:' . $subject->topics->first()->id);
        }

        return redirect('/practice')->withStatus('There are no topics under ' . $subject->name );

    }

    public function topic($slug, Topic $topic)
    {
        $subject = $topic->subject;
        $problems = $topic->problems()->paginate(10);
        $topicgroup = 'Problems under <b class="text-grey-darkest">' . $topic->name . '</b>.';
        return view('practice.topic', compact('subject', 'topic', 'problems', 'topicgroup'));
    }

     public function problem($slug, Topic $topic, $problemSlug)
    {
        $subject = $topic->subject;
        $problem = Problem::where('slug', $problemSlug)->first();
        return view('practice.problem', compact('subject', 'topic', 'problem'));
    }
}
