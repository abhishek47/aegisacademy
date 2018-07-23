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

        return view('wikis.show2', compact('wiki'));
    }

    /**
    * Get body of wiki by id
    *
    * @return wiki show page
    */
    public function getBody(Wiki $wiki)
    {
        return response(['body' => $wiki->body], 200);
    }

    /**
     * update body of wiki by id
     *
     * @return wiki show page
     */

    public function updateBody(Request $request, Wiki $wiki)
    {
        $wiki->body = $request->get('body');

        $wiki->save();

        return response([$request->get('body')], 200);
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
