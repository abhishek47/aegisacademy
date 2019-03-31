<?php

namespace App\Http\Controllers;

use App\Models\Wiki;
use App\Models\WikiCategory;
use Illuminate\Http\Request;

class WikisController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($categoryId = null)
    {
        $wikigroup = "All Wiki Pages";
        if(isset($categoryId))
        {
           $articles = Wiki::where('wiki_category_id', $categoryId)->where('published', 1)->orderBy('created_at', "DESC");
           $category = WikiCategory::find($categoryId);
           $wikigroup = $category->name  . ' Wiki Pages';
        } else {
           $articles = Wiki::where('published', 1)->orderBy('created_at', "DESC");
        }

        if(request()->has('query') && request('query') != '')
        {
            $articles = $articles->where('title', 'Like', '%' . request('query') . '%')->paginate(10);
            $wikigroup = $wikigroup . ' related to \'' . request('query') . '\'';
        } else {
            $articles = $articles->paginate(10);
        }

        $categories = WikiCategory::orderBy('name', "DESC")->get();
        return view('wikis.index', compact('articles', 'categories', 'categoryId', 'wikigroup'));
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
