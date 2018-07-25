<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemsController extends Controller
{
    public function get(Problem $problem)
    {
        return response(['problem' => $problem], 200);
    }
}
