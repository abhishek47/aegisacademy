<?php

namespace App\Http\Controllers;

use App\Models\Wiki;
use App\Models\WikiCategory;
use App\Models\ProblemQuestion;
use Illuminate\Http\Request;
use StdClass;

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
        $questioncount = ProblemQuestion::where('wiki_id', $wiki->id)->count();
        $problems = ProblemQuestion::where('wiki_id', $wiki->id)->get();
        // $

        $problem = new StdClass;
        $problem->questions = $problems;
        $problem = json_encode($problem);


    //     "id" => 25
    // "title" => "Practice Problems"
    // "slug" => "practice-problems"
    // "banner" => "storage/uploads/courses/banners/bc2d59208539e589a499466a76075a29.png"
    // "content_type" => 2
    // "body" => null
    // "video" => null
    // "problem_id" => 4
    // "completed" => 0
    // "created_at" => "2018-11-04 03:06:42"
    // "updated_at" => "2018-11-04 03:06:42"
    // "sequence" => 11
    // "course_id" => 2
    // "course_chapter_id" => 3
        

        // if($chapter->sections()->count() == $chapter->sections()->completed()->count())
        // {
        //     $section->chapter->finish();
        // }



        return view('wikis.show', compact('wiki', 'problem', 'questioncount'));
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
