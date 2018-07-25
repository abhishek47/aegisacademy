<?php

namespace App\Http\Controllers;

use App\Models\Wiki;
use Illuminate\Http\Request;

class RateWikiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Wiki $wiki)
    {
        if(auth()->user()->ratedWikis->contains($wiki))
        {
            $rating = auth()->user()->ratedWikis()->where('wiki_id', $wiki->id)->first();
            $rating->pivot->rating = request('rating');
            $rating->save();
        } else {
            auth()->user()->ratedWikis()->attach($wiki, ['rating' => request('rating')]);
        }

        return response(['success', 200]);
    }
}
