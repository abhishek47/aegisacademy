<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($filter = null)
    {
        $threadgroup = 'All Threads';

        if(isset($filter))
        {
            if($filter == 'mine')
            {
                $discussions = auth()->user()->discussions()->latest();
                $threadgroup = 'My Threads';
            } else if($filter == 'popular') {
                $discussions = Discussion::latest()->popular();
                $threadgroup = 'Popular Threads';
            } else if($filter == 'unanswered') {
                $discussions = Discussion::latest()->unanswered();
                 $threadgroup = 'Unanswered Threads';
            } else if($filter == 'closed') {
                $discussions = Discussion::latest()->closed();
                 $threadgroup = 'Closed Threads';
            } else {
                return redirect('/discussions');
            }
        } else {
            $discussions = Discussion::latest();
        }

        if(request()->has('query') && request('query') != '')
        {
            $discussions = $discussions->where('title', 'LIKE', '%' . request('query') . '%')->paginate(10);
            $threadgroup =  $threadgroup . ' related to \'' . request('query') . '\'';
        } else {
            $discussions = $discussions->paginate(10);
        }

        return view('discussions.index', compact('discussions', 'threadgroup'));
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

    public function update(Discussion $discussion)
    {
        request()->validate([
            'title' => 'required',
            'body'  => 'required'
        ]);

        $discussion->update(['title' => request('title'), 'body' => request('body')]);

        return response(['discussion_id' => $discussion->id], 200);
    }

    public function show(Discussion $discussion)
    {
        return view('discussions.show', compact('discussion'));
    }

    public function destroy(Discussion $discussion)
    {
        $discussion->delete();

        return redirect('/discussions');
    }
}
