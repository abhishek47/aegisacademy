<?php

namespace App\Http\Controllers;

use App\Models\Wiki;
use Illuminate\Http\Request;

class WikisController extends Controller
{
	
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


	/**
     * List all wiki articles
     *
     * @return index view with wiki articles
     */
   
    public function index()
    {
    	$articles = Wiki::orderBy('created_at', "DESC")->paginate(10);

    	return view('wikis.index', compact('articles'));
    }


    /**
     * Show single wiki page by slug
     *
     * @return wiki show page
     */
   
    public function show($slug)
    {
    	$wiki = Wiki::where('slug', $slug)->first();

    	return view('wikis.show', compact('wiki'));
    }

    /**
     * Update the wiki page
     *
     * @return wiki show page
     */

    public function update(Request $request, Wiki $wiki)
    {
    	$request->validate([
                'comment'  => 'required',
    		]);

    	$wiki->body = $request->get('comment');

    	$wiki->save();

    	return redirect($wiki->url);
    }

}
