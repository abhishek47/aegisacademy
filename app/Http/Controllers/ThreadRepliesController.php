<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\ThreadReply;
use Illuminate\Http\Request;

class ThreadRepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Discussion $discussion)
    {
        $discussion->replies()->create(['body' => request('body'), 'user_id' => auth()->id()]);

        return back();
    }

    public function update(ThreadReply $reply)
    {
        $reply->update(['body' => request('body')]);

        return response(['success'], 200);
    }

    public function best(ThreadReply $reply)
    {
        $reply->thread->markBestReply($reply);

        return response(['success'], 200);
    }

    public function like(ThreadReply $reply)
    {
        auth()->user()->likedReplies()->attach($reply);

        return response(['like_string' => $reply->likes_string], 200);
    }

    public function dislike(ThreadReply $reply)
    {
        auth()->user()->likedReplies()->detach($reply);

        return response(['like_string' => $reply->likes_string], 200);
    }

    public function destroy(ThreadReply $reply)
    {
        $reply->delete();

        return response(['success'], 200);
    }

}
