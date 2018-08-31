<?php

namespace App\Http\Controllers;

use App\Models\Subsection;
use Illuminate\Http\Request;

class SubsectionsController extends Controller
{
    public function getArticleBody(Subsection $subsection)
    {
        return response(['body' => $subsection->body], 200);
    }

}
