<?php

namespace App\Http\Controllers;

use App\Models\Wiki;
use Illuminate\Http\Request;

class ReadWikiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Wiki $wiki)
    {
        auth()->user()->readWikis()->attach($wiki);

        auth()->user()->xp += 300;

        auth()->user()->save();

        return response(['success', 200]);
    }

    public function destroy(Wiki $wiki)
    {
        auth()->user()->readWikis()->detach($wiki);

        auth()->user()->xp -= 300;

        auth()->user()->save();

        return response(['success', 200]);
    }
}
