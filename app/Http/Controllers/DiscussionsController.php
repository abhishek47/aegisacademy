<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    public function index()
    {
        $discussions = Discussion::latest()->paginate(10);
        return view('discussions.index', compact('discussions'));
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'body'  => 'required'
        ]);

        $discussion = auth()->user()->discussions()->create(['title' => request('title'), 'body' => request('body')]);

        return response(['discussion_id' => $discussion->id], 200);
    }

    public function show($discussion)
    {
        return view('discussions.show', compact('discussion'));
    }
}
